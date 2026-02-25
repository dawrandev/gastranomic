importScripts('https://www.gstatic.com/firebasejs/10.7.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.7.0/firebase-messaging-compat.js');

// Initialize the Firebase app in the service worker
// IMPORTANT: Replace these values with your actual Firebase project credentials
// Import the functions you need from the SDKs you need


const firebaseConfig = {
    apiKey: "AIzaSyBgMtPMATJwaA1IAgJef2nksTG_P-RJEnc",
    authDomain: "gastranomic-6377c.firebaseapp.com",
    projectId: "gastranomic-6377c",
    storageBucket: "gastranomic-6377c.firebasestorage.app",
    messagingSenderId: "911893928589",
    appId: "1:911893928589:web:85db2725899d618eb320c4"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

// Handle background messages
messaging.onBackgroundMessage((payload) => {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: '/favicon.ico', // Replace with your logo path
        badge: '/favicon.ico',
        data: payload.data,
        tag: 'review-notification',
        requireInteraction: true, // Notification stays until user interacts
    };

    return self.registration.showNotification(notificationTitle, notificationOptions);
});

// Handle notification click
self.addEventListener('notificationclick', (event) => {
    console.log('[firebase-messaging-sw.js] Notification click received.', event);

    event.notification.close();

    // Open the click_action URL or default to admin dashboard
    const clickAction = event.notification.data?.click_action || '/admin/dashboard';

    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true })
            .then((clientList) => {
                // Check if there's already a window open
                for (const client of clientList) {
                    if (client.url.includes('/admin') && 'focus' in client) {
                        return client.focus().then(() => client.navigate(clickAction));
                    }
                }
                // If no window is open, open a new one
                if (clients.openWindow) {
                    return clients.openWindow(clickAction);
                }
            })
    );
});
