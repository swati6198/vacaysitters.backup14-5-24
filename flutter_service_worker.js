'use strict';
const MANIFEST = 'flutter-app-manifest';
const TEMP = 'flutter-temp-cache';
const CACHE_NAME = 'flutter-app-cache';

const RESOURCES = {"version.json": "84ee74d259895e01a18aa5d1f3eca403",
"index.html": "ade1e6179c704cbcbe464af465a9553d",
"/": "ade1e6179c704cbcbe464af465a9553d",
"firebase-messaging-sw.js": "93525db0f2de554a607738874b47ed10",
"main.dart.js": "492008eb5c2ec7201fc589576f9c331a",
"flutter.js": "7d69e653079438abfbb24b82a655b0a4",
"favicon.png": "5dcef449791fa27946b3d35ad8803796",
"icons/favicon.ico": "e835b02c27741516ed79724fc77d5003",
"icons/apple-touch-icon.png": "433a2dfddb11003d73ca8fc220e3a11e",
"icons/icon-192.png": "8184a23318b1cba40484e16adb41bcef",
"icons/Icon-maskable-192.png": "c457ef57daa1d16f64b27b786ec2ea3c",
"icons/icon-192-maskable.png": "f534e02633e0feca61eac62de8208361",
"icons/icon-512-maskable.png": "4f01924f2c0298874e039747810e1451",
"icons/Icon-maskable-512.png": "301a7604d45b3e739efc881eb04896ea",
"icons/icon-512.png": "cf53bf64b575b6975f88ed6fe985645d",
"manifest.json": "b91d81e039ee6c3a71e2fe8ea13a4f5e",
"assets/AssetManifest.json": "3e3d89083075428875dbace0d30146eb",
"assets/NOTICES": "1bd9bfc322cb2df80a71e31d881e1535",
"assets/FontManifest.json": "88c1d6584052be144cdd992baedcbd5d",
"assets/AssetManifest.bin.json": "cbf7dd11a438add418e7ef893acf9544",
"assets/packages/cupertino_icons/assets/CupertinoIcons.ttf": "e986ebe42ef785b27164c36a9abc7818",
"assets/packages/flutter_google_places/assets/google_white.png": "40bc3ae5444eae0b9228d83bfd865158",
"assets/packages/flutter_google_places/assets/google_black.png": "97f2acfb6e993a0c4134d9d04dff21e2",
"assets/packages/fluttertoast/assets/toastify.js": "56e2c9cedd97f10e7e5f1cebd85d53e3",
"assets/packages/fluttertoast/assets/toastify.css": "a85675050054f179444bc5ad70ffc635",
"assets/shaders/ink_sparkle.frag": "4096b5150bac93c41cbc9b45276bd90f",
"assets/AssetManifest.bin": "033a1e2642f4fae7ad0b1623112a1159",
"assets/fonts/MaterialIcons-Regular.otf": "946682613433467861ebcfbadb7ea469",
"assets/Assets/svg/ic_filter.svg": "d6e1302f99634a0ee8d35f1a27e722cc",
"assets/Assets/svg/profile_billing.svg": "81aab6e4368b5b2288e042253d48f428",
"assets/Assets/svg/nav_activce_orders.svg": "72ce8fa5c34cc465deac3e613cf863f2",
"assets/Assets/svg/profile-rewards.svg": "3d37a35b7a9a047ab1cfcfa38beff050",
"assets/Assets/svg/nav_inactive_search.svg": "09f9f0518858c35658d0c59cce259cf9",
"assets/Assets/svg/ic_location.svg": "9c88451e3a0adb77fc695fd4aa254855",
"assets/Assets/svg/ic_notification_icon.svg": "ac4357f86dd7746dfd7d472af0f9d057",
"assets/Assets/svg/profile-ratings.svg": "59d6d65b26d928e5438ac36032bf251c",
"assets/Assets/svg/nav_orders_white.svg": "6d35538b344f6a3f733c9bbb09dfd64a",
"assets/Assets/svg/ic_gold_badge.svg": "d37e1b78a89ee7e4e2af793c4bb7b5f5",
"assets/Assets/svg/ic_calendar.svg": "4fbec837fb3d20985c3d33ed2c1a1f36",
"assets/Assets/svg/ic_maps_home.svg": "23e449b90c9389b82b134bf21d59ba31",
"assets/Assets/svg/ic_notifications.svg": "27b2e1f06b43d2e5fc19dd86d2d2e077",
"assets/Assets/svg/profile_priv_poli.svg": "6e80a75cef5c43d73c14297f5b404c18",
"assets/Assets/svg/profile_manage_pets.svg": "b93ffaa12b6fc1fa8fc620477428ed33",
"assets/Assets/svg/ic_photo_verification_done.svg": "1c109d46b7bac318211327884c3e9667",
"assets/Assets/svg/ic_background_check.svg": "4281a796d6dab87945bd641fc21bae09",
"assets/Assets/svg/ic_jobs.svg": "8c445beb34bd67d986f12374297bad0d",
"assets/Assets/svg/ic_rewards.svg": "0b70c1e82d16b79c4400641add036211",
"assets/Assets/svg/ic_distance.svg": "9eefcc42e469de58c7afc9ab9f80fc82",
"assets/Assets/svg/img_invite.svg": "936f6a10e268ce8ba7418bd779584583",
"assets/Assets/svg/nav_activce_search.svg": "8106ecb6781ad659f4ee57d37098b06c",
"assets/Assets/svg/ic_navigation.svg": "b5cb41c8e77838542948c56549ac8f83",
"assets/Assets/svg/ic_dates.svg": "ce67c5e99e9c7df0bbb0804ef46e772b",
"assets/Assets/svg/ic_verified.svg": "ce92b13dfd546bf976f6870da1f3ac72",
"assets/Assets/svg/nav_activce_profile.svg": "caea324441ddd22762af73bddf45a840",
"assets/Assets/svg/nav_inactive_profile.svg": "456ad191025e9ab037245d0931bc0fbc",
"assets/Assets/svg/nav_inactive_orders.svg": "197e881a2ba87cca474c7ac58015fd2d",
"assets/Assets/svg/profile-invite.svg": "d20d1c295fcf3e70035efc059679d3fd",
"assets/Assets/svg/nav_inactive_home.svg": "a002ec7e780a3ec6c499a58ed319efb4",
"assets/Assets/svg/ic_locator_pin.svg": "53d05c8e8be432cd517e2a4ca56b8930",
"assets/Assets/svg/profile_placeholder_img.svg": "804a0979c44549db564a4c5e836c85ab",
"assets/Assets/svg/profile_user_details.svg": "7eb894ec3463fe71f2a0a8911ef15ba9",
"assets/Assets/svg/profile_faq.svg": "69142f50db894bfb8e5e6b50b94c7296",
"assets/Assets/svg/ic_ratings.svg": "4692f93699c6b46331c5218903e2eb6f",
"assets/Assets/svg/ic_logout.svg": "653264d50000858229a549f3a8373cdf",
"assets/Assets/svg/nav_activce_home.svg": "5718e6a0d4fd55386ecfb4e7381977f5",
"assets/Assets/png/home_banner_img2.png": "9e89e538635c042151d23a46abd41ba1",
"assets/Assets/png/ic_pet_cat.png": "088d75d0dc46ae30050b8a2ee633a60d",
"assets/Assets/png/pet_care_giver.jpg": "41227dcdc4107fd1f6ee66770d91a2ab",
"assets/Assets/png/ic_whatsapp.png": "b3b65ca59af8ac0742ae31631c6598a9",
"assets/Assets/png/screen_2.png": "1f4890511644c36e42e8ecc9261dfd00",
"assets/Assets/png/screen_3.png": "bb9446989f2895a4e89326c4eb88e82e",
"assets/Assets/png/screen_1.png": "f5f443189a0144ecc2bd2ef40c1290d4",
"assets/Assets/png/login_bg_img2.png": "8135b1a687c0fd0a0fc7923b9f6dae67",
"assets/Assets/png/booking_success_bg.png": "29c6af53f7e91572d57518c2a3ab2ad7",
"assets/Assets/png/house_care_giver.jpg": "6f582f641d9be1767bbe259d81c4a451",
"assets/Assets/png/ic_pet_dog.png": "71d04926c71530799909659851254e4e",
"assets/Assets/logo/app_logo.png": "94d7b7e4d6ff8c15270a9006736f3edc",
"assets/Assets/fonts/Roboto-Light.ttf": "881e150ab929e26d1f812c4342c15a7c",
"assets/Assets/fonts/Roboto-Regular.ttf": "8a36205bd9b83e03af0591a004bc97f4",
"assets/Assets/fonts/Roboto-LightItalic.ttf": "5788d5ce921d7a9b4fa0eaa9bf7fec8d",
"assets/Assets/fonts/Roboto-Italic.ttf": "cebd892d1acfcc455f5e52d4104f2719",
"assets/Assets/fonts/Roboto-BlackItalic.ttf": "c3332e3b8feff748ecb0c6cb75d65eae",
"assets/Assets/fonts/Roboto-Bold.ttf": "b8e42971dec8d49207a8c8e2b919a6ac",
"assets/Assets/fonts/Roboto-Black.ttf": "d6a6f8878adb0d8e69f9fa2e0b622924",
"canvaskit/skwasm.js": "87063acf45c5e1ab9565dcf06b0c18b8",
"canvaskit/skwasm.wasm": "2fc47c0a0c3c7af8542b601634fe9674",
"canvaskit/chromium/canvaskit.js": "0ae8bbcc58155679458a0f7a00f66873",
"canvaskit/chromium/canvaskit.wasm": "143af6ff368f9cd21c863bfa4274c406",
"canvaskit/canvaskit.js": "eb8797020acdbdf96a12fb0405582c1b",
"canvaskit/canvaskit.wasm": "73584c1a3367e3eaf757647a8f5c5989",
"canvaskit/skwasm.worker.js": "bfb704a6c714a75da9ef320991e88b03"};
// The application shell files that are downloaded before a service worker can
// start.
const CORE = ["main.dart.js",
"index.html",
"assets/AssetManifest.json",
"assets/FontManifest.json"];

// During install, the TEMP cache is populated with the application shell files.
self.addEventListener("install", (event) => {
  self.skipWaiting();
  return event.waitUntil(
    caches.open(TEMP).then((cache) => {
      return cache.addAll(
        CORE.map((value) => new Request(value, {'cache': 'reload'})));
    })
  );
});
// During activate, the cache is populated with the temp files downloaded in
// install. If this service worker is upgrading from one with a saved
// MANIFEST, then use this to retain unchanged resource files.
self.addEventListener("activate", function(event) {
  return event.waitUntil(async function() {
    try {
      var contentCache = await caches.open(CACHE_NAME);
      var tempCache = await caches.open(TEMP);
      var manifestCache = await caches.open(MANIFEST);
      var manifest = await manifestCache.match('manifest');
      // When there is no prior manifest, clear the entire cache.
      if (!manifest) {
        await caches.delete(CACHE_NAME);
        contentCache = await caches.open(CACHE_NAME);
        for (var request of await tempCache.keys()) {
          var response = await tempCache.match(request);
          await contentCache.put(request, response);
        }
        await caches.delete(TEMP);
        // Save the manifest to make future upgrades efficient.
        await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
        // Claim client to enable caching on first launch
        self.clients.claim();
        return;
      }
      var oldManifest = await manifest.json();
      var origin = self.location.origin;
      for (var request of await contentCache.keys()) {
        var key = request.url.substring(origin.length + 1);
        if (key == "") {
          key = "/";
        }
        // If a resource from the old manifest is not in the new cache, or if
        // the MD5 sum has changed, delete it. Otherwise the resource is left
        // in the cache and can be reused by the new service worker.
        if (!RESOURCES[key] || RESOURCES[key] != oldManifest[key]) {
          await contentCache.delete(request);
        }
      }
      // Populate the cache with the app shell TEMP files, potentially overwriting
      // cache files preserved above.
      for (var request of await tempCache.keys()) {
        var response = await tempCache.match(request);
        await contentCache.put(request, response);
      }
      await caches.delete(TEMP);
      // Save the manifest to make future upgrades efficient.
      await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
      // Claim client to enable caching on first launch
      self.clients.claim();
      return;
    } catch (err) {
      // On an unhandled exception the state of the cache cannot be guaranteed.
      console.error('Failed to upgrade service worker: ' + err);
      await caches.delete(CACHE_NAME);
      await caches.delete(TEMP);
      await caches.delete(MANIFEST);
    }
  }());
});
// The fetch handler redirects requests for RESOURCE files to the service
// worker cache.
self.addEventListener("fetch", (event) => {
  if (event.request.method !== 'GET') {
    return;
  }
  var origin = self.location.origin;
  var key = event.request.url.substring(origin.length + 1);
  // Redirect URLs to the index.html
  if (key.indexOf('?v=') != -1) {
    key = key.split('?v=')[0];
  }
  if (event.request.url == origin || event.request.url.startsWith(origin + '/#') || key == '') {
    key = '/';
  }
  // If the URL is not the RESOURCE list then return to signal that the
  // browser should take over.
  if (!RESOURCES[key]) {
    return;
  }
  // If the URL is the index.html, perform an online-first request.
  if (key == '/') {
    return onlineFirst(event);
  }
  event.respondWith(caches.open(CACHE_NAME)
    .then((cache) =>  {
      return cache.match(event.request).then((response) => {
        // Either respond with the cached resource, or perform a fetch and
        // lazily populate the cache only if the resource was successfully fetched.
        return response || fetch(event.request).then((response) => {
          if (response && Boolean(response.ok)) {
            cache.put(event.request, response.clone());
          }
          return response;
        });
      })
    })
  );
});
self.addEventListener('message', (event) => {
  // SkipWaiting can be used to immediately activate a waiting service worker.
  // This will also require a page refresh triggered by the main worker.
  if (event.data === 'skipWaiting') {
    self.skipWaiting();
    return;
  }
  if (event.data === 'downloadOffline') {
    downloadOffline();
    return;
  }
});
// Download offline will check the RESOURCES for all files not in the cache
// and populate them.
async function downloadOffline() {
  var resources = [];
  var contentCache = await caches.open(CACHE_NAME);
  var currentContent = {};
  for (var request of await contentCache.keys()) {
    var key = request.url.substring(origin.length + 1);
    if (key == "") {
      key = "/";
    }
    currentContent[key] = true;
  }
  for (var resourceKey of Object.keys(RESOURCES)) {
    if (!currentContent[resourceKey]) {
      resources.push(resourceKey);
    }
  }
  return contentCache.addAll(resources);
}
// Attempt to download the resource online before falling back to
// the offline cache.
function onlineFirst(event) {
  return event.respondWith(
    fetch(event.request).then((response) => {
      return caches.open(CACHE_NAME).then((cache) => {
        cache.put(event.request, response.clone());
        return response;
      });
    }).catch((error) => {
      return caches.open(CACHE_NAME).then((cache) => {
        return cache.match(event.request).then((response) => {
          if (response != null) {
            return response;
          }
          throw error;
        });
      });
    })
  );
}
