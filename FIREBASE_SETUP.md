# Firebase Cloud Messaging (FCM) Setup Guide

## Overview
This application uses Firebase Cloud Messaging (FCM) to send push notifications to admin users when guests create new reviews.

## Prerequisites
- Google account
- Laravel application running
- HTTPS enabled (required for service workers)

---

## Step 1: Create Firebase Project

1. Go to [Firebase Console](https://console.firebase.google.com)
2. Click **"Add project"** or select an existing project
3. Enter project name (e.g., "RestReviews")
4. Disable Google Analytics (optional)
5. Click **"Create project"**

---

## Step 2: Register Web App

1. In your Firebase project, click the **Web icon** (`</>`) to add a web app
2. Enter app nickname: "RestReviews Admin Panel"
3. Check **"Also set up Firebase Hosting"** (optional)
4. Click **"Register app"**
5. Copy the Firebase configuration object (you'll need this later)

```javascript
const firebaseConfig = {
  apiKey: "AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
  authDomain: "your-project.firebaseapp.com",
  projectId: "your-project-id",
  storageBucket: "your-project.appspot.com",
  messagingSenderId: "123456789012",
  appId: "1:123456789012:web:abcdef123456"
};
```

---

## Step 3: Enable Cloud Messaging

1. In Firebase Console, go to **Project Settings** (⚙️ icon)
2. Navigate to **"Cloud Messaging"** tab
3. Under **"Web Push certificates"**, click **"Generate key pair"**
4. Copy the **VAPID key** (starts with `B...`)

---

## Step 4: Get Service Account JSON

1. In Firebase Console, go to **Project Settings** → **"Service accounts"** tab
2. Click **"Generate new private key"**
3. Confirm by clicking **"Generate key"**
4. A JSON file will be downloaded (e.g., `your-project-firebase-adminsdk-xxxxx.json`)
5. Rename it to `firebase-credentials.json`
6. Move it to `storage/app/firebase-credentials.json` in your Laravel project

**Security Warning:** Never commit this file to version control! Add to `.gitignore`:
```
storage/app/firebase-credentials.json
```

---

## Step 5: Update Laravel Configuration

### 5.1 Environment Variables

Add to your `.env` file:
```env
FIREBASE_CREDENTIALS=firebase-credentials.json
```

### 5.2 Update Service Worker

Edit `public/firebase-messaging-sw.js` and replace the configuration:

```javascript
firebase.initializeApp({
    apiKey: "YOUR_API_KEY",                    // From Step 2
    authDomain: "YOUR_PROJECT.firebaseapp.com", // From Step 2
    projectId: "YOUR_PROJECT_ID",               // From Step 2
    storageBucket: "YOUR_PROJECT.appspot.com",  // From Step 2
    messagingSenderId: "YOUR_SENDER_ID",        // From Step 2
    appId: "YOUR_APP_ID"                        // From Step 2
});
```

### 5.3 Update Admin Dashboard

Edit `resources/views/pages/admin/dashboard.blade.php` and find the Firebase configuration section (around line 390):

```javascript
const firebaseConfig = {
    apiKey: "YOUR_API_KEY",                    // From Step 2
    authDomain: "YOUR_PROJECT.firebaseapp.com", // From Step 2
    projectId: "YOUR_PROJECT_ID",               // From Step 2
    storageBucket: "YOUR_PROJECT.appspot.com",  // From Step 2
    messagingSenderId: "YOUR_SENDER_ID",        // From Step 2
    appId: "YOUR_APP_ID"                        // From Step 2
};

const vapidKey = "YOUR_VAPID_KEY"; // From Step 3
```

---

## Step 6: Verify File Structure

Ensure these files exist:

```
project-root/
├── storage/app/firebase-credentials.json      # Service account JSON (DO NOT COMMIT)
├── public/firebase-messaging-sw.js            # Service worker
├── app/Services/FcmNotificationService.php    # Notification service
├── app/Http/Controllers/Admin/FcmController.php # Token management
├── database/migrations/XXXX_add_fcm_token_to_users_table.php
└── resources/views/pages/admin/dashboard.blade.php # Updated with Firebase SDK
```

---

## Step 7: Test the Implementation

### 7.1 Backend Test

```bash
# Run migrations
php artisan migrate

# Check if fcm_token column exists
php artisan tinker
>>> Schema::hasColumn('users', 'fcm_token')
# Should return: true
```

### 7.2 Frontend Test

1. Open admin panel in **Chrome or Firefox** (required for notifications)
2. Go to Admin Dashboard
3. You should see **"Push уведомления"** card
4. Click **"Включить уведомления"** button
5. Browser will prompt for permission → Click **"Allow"**
6. Status should change to **"Включены"** (green badge)

### 7.3 Database Verification

```bash
php artisan tinker
>>> \App\Models\User::find(1)->fcm_token
# Should return a long string (152+ characters)
```

### 7.4 End-to-End Test

1. Keep admin dashboard open in browser
2. Open Postman or another browser tab
3. Create a test review via API:

```bash
POST http://your-domain.com/api/restaurants/1/reviews
Content-Type: application/json

{
    "device_id": "test-device-123",
    "rating": 5,
    "comment": "Test notification!"
}
```

4. Admin should receive a browser notification: **"Yangi sharh!"**
5. Click notification → Should open review page

---

## Troubleshooting

### Issue: "Notification permission denied"
**Solution:** Clear browser site settings and reload page, then click enable again.

### Issue: "Service worker registration failed"
**Solution:** Ensure your site is served over HTTPS (required for service workers).

### Issue: "FCM token not saved"
**Check:**
1. CSRF token is present in page (`<meta name="csrf-token">`)
2. Admin user is authenticated
3. Check Laravel logs: `tail -f storage/logs/laravel.log`

### Issue: "Notification not received"
**Debug steps:**
1. Check if `fcm_token` exists in database for admin user
2. Check Laravel logs for FCM errors
3. Verify Firebase service account JSON is correct
4. Ensure restaurant has `user_id` (admin) assigned

### Issue: "Invalid FCM token"
**Solution:** Token is automatically removed from database. Admin needs to re-enable notifications.

---

## Security Considerations

### 1. Service Account JSON
- **Never** commit to Git
- Store in `storage/app/` (outside public directory)
- Add to `.gitignore`

### 2. Firebase Credentials
- VAPID key can be public (it's safe to expose in frontend)
- API key restrictions should be set in Firebase Console:
  - Go to Google Cloud Console → Credentials
  - Restrict API key to your domain only

### 3. Rate Limiting
- FCM token endpoints are protected by Laravel authentication
- Review creation already has rate limiting (3 per day per restaurant)

### 4. Token Management
- Tokens are automatically invalidated if FCM reports them as invalid
- Admins can disable notifications anytime

---

## Firebase Console URLs

- **Firebase Console:** https://console.firebase.google.com
- **Google Cloud Console:** https://console.cloud.google.com
- **Firebase Documentation:** https://firebase.google.com/docs/cloud-messaging

---

## API Endpoints

### Save FCM Token
```
POST /admin/fcm-token
Headers: Cookie (session authenticated)
Body: { "fcm_token": "ey..." }
Response: { "success": true, "message": "FCM token saved successfully" }
```

### Remove FCM Token
```
DELETE /admin/fcm-token
Headers: Cookie (session authenticated)
Response: { "success": true, "message": "FCM token removed successfully" }
```

---

## Notification Payload Structure

```javascript
{
  "notification": {
    "title": "Yangi sharh!",
    "body": "Restoraningizga yangi ⭐⭐⭐⭐⭐ sharh qoldirildi"
  },
  "data": {
    "type": "new_review",
    "review_id": "123",
    "restaurant_id": "5",
    "rating": "5",
    "click_action": "https://your-domain.com/admin/reviews/123"
  }
}
```

---

## Monitoring

### Laravel Logs
```bash
# Watch for FCM logs
tail -f storage/logs/laravel.log | grep FCM
```

### Browser Console
```javascript
// Check if service worker is registered
navigator.serviceWorker.getRegistrations().then(registrations => {
    console.log('Service Workers:', registrations);
});

// Check notification permission
console.log('Notification permission:', Notification.permission);
```

---

## Production Checklist

- [ ] Firebase project created
- [ ] Service account JSON downloaded and placed in `storage/app/`
- [ ] `.env` updated with `FIREBASE_CREDENTIALS`
- [ ] `firebase-messaging-sw.js` updated with config
- [ ] Admin dashboard updated with config and VAPID key
- [ ] HTTPS enabled (required for service workers)
- [ ] Tested notification flow end-to-end
- [ ] Firebase API key restricted to production domain
- [ ] `firebase-credentials.json` added to `.gitignore`

---

## Support

For issues or questions:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check browser console for JavaScript errors
3. Review Firebase Console → Cloud Messaging for errors
4. Verify all configuration values are correct

---

## Architecture Overview

```
Guest creates review
    ↓
ReviewController::store()
    ↓
ReviewService::createOrUpdateReview()
    ↓
FcmNotificationService::sendNewReviewNotification()
    ↓
Firebase Cloud Messaging API
    ↓
Admin's browser (via Service Worker)
    ↓
Browser shows notification
    ↓
Admin clicks → Opens review page
```

---

## What Happens When...

### Notification is sent but admin browser is closed?
✅ Service Worker handles it in background. Notification appears when browser reopens.

### Admin has multiple tabs open?
✅ All tabs receive the notification. Click action focuses/navigates one tab.

### Admin clears browser data?
❌ FCM token is lost. Admin must re-enable notifications.

### Review creation fails?
✅ Notification failure doesn't affect review creation (try-catch wrapper).

### Admin doesn't have FCM token?
✅ Notification is skipped silently. Review is still created.

---

## Next Steps

After successful setup:
1. Test with real reviews in production
2. Monitor Laravel logs for any FCM errors
3. Customize notification messages in `FcmNotificationService.php`
4. Add notification preferences (per restaurant, rating threshold, etc.)
5. Consider adding sound/vibration to notifications

---

**Last Updated:** 2026-02-25
**Laravel Version:** 11.x
**Firebase SDK Version:** 10.7.0
