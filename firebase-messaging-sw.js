importScripts('https://www.gstatic.com/firebasejs/8.4.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.4.1/firebase-messaging.js');

/*Update with yours config*/
const firebaseConfig = {
  apiKey: "AIzaSyCWDuqi29YWwtMiGARBh051T0dN0Xz0HbQ",
  authDomain: "vacay-sitters-user.firebaseapp.com",
  projectId: "vacay-sitters-user",
  storageBucket: "vacay-sitters-user.appspot.com",
  messagingSenderId: "710634738281",
  appId: "1:710634738281:web:4230783d4841b7a16c48f8",
  measurementId: "G-C83RLTVC9D"
};
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

/*messaging.onMessage((payload) => {
console.log('Message received. ', payload);*/
messaging.onBackgroundMessage(function (payload) {
  console.log('Received background message ', payload);

  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
  };

  self.registration.showNotification(notificationTitle,
    notificationOptions);
});