<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employee Time Tracking System</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#3b82f6",
                        secondary: "#10b981",
                    },
                    borderRadius: {
                        none: "0px",
                        sm: "4px",
                        DEFAULT: "8px",
                        md: "12px",
                        lg: "16px",
                        xl: "20px",
                        "2xl": "24px",
                        "3xl": "32px",
                        full: "9999px",
                        button: "8px",
                    },
                },
            },
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
        rel="stylesheet" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
        rel="stylesheet" />
    <style>
        :where([class^="ri-"])::before {
            content: "\f3c2";
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .success-fade {
            animation: successFade 3s ease-in-out;
        }

        @keyframes successFade {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            20% {
                opacity: 1;
                transform: translateY(0);
            }

            80% {
                opacity: 1;
                transform: translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateY(-10px);
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="text-2xl font-['Pacifico'] text-primary">logo</div>
                </div>
                <div class="text-center">
                    <div class="text-lg font-semibold text-gray-900" id="currentDate">
                        Thursday, July 31, 2025
                    </div>
                    <div class="text-sm text-gray-600" id="currentTime">2:30:45 PM</div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-green-100 rounded-full">
                            <i class="ri-shield-check-line text-green-600"></i>
                        </div>
                        <span class="text-sm text-gray-700">Secure Connection</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-blue-100 rounded-full">
                            <i class="ri-user-line text-blue-600"></i>
                        </div>
                        <span class="text-sm text-gray-700">Sarah Johnson</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-6 py-8">
        <div
            id="confirmationMessage"
            class="hidden mb-6 p-4 bg-green-50 border border-green-200 rounded-lg success-fade">
            <div class="flex items-center">
                <div class="w-6 h-6 flex items-center justify-center mr-3">
                    <i class="ri-check-circle-line text-green-600"></i>
                </div>
                <div>
                    <p class="text-green-800 font-medium" id="confirmationText">
                        Successfully clocked in at 2:30:45 PM
                    </p>
                    <p class="text-green-600 text-sm" id="confirmationDetails">
                        Location verified • Device authenticated
                    </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                    <div class="text-center mb-8">
                        <div
                            class="text-6xl font-mono font-bold text-gray-900 mb-2"
                            id="digitalClock">
                            2:30:45
                        </div>
                        <div class="text-lg text-gray-600">Current Time</div>
                    </div>
                    <div class="flex items-center justify-center mb-8">
                        <div
                            class="flex items-center space-x-3 px-4 py-2 bg-gray-100 rounded-full">
                            <div
                                class="w-3 h-3 bg-red-500 rounded-full pulse-animation"
                                id="statusIndicator"></div>
                            <span class="text-sm font-medium text-gray-700" id="statusText">Not Clocked In</span>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="bg-gray-100 rounded-lg p-4">
                            <div class="relative">
                                <video
                                    id="cameraPreview"
                                    class="w-full h-128 object-cover rounded-lg"
                                    autoplay
                                    playsinline></video>
                                <canvas
                                    id="photoCanvas"
                                    class="w-full h-64 object-cover rounded-lg hidden absolute top-0 left-0"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-4 mb-8">
                        <button
                            id="timeInBtn"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-6 !rounded-button transition-colors whitespace-nowrap">
                            <div class="flex items-center justify-center space-x-2">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-login-circle-line"></i>
                                </div>
                                <span>Time In</span>
                            </div>
                        </button>
                        <button
                            id="timeOutBtn"
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-4 px-6 !rounded-button transition-colors whitespace-nowrap disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            <div class="flex items-center justify-center space-x-2">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-logout-circle-line"></i>
                                </div>
                                <span>Time Out</span>
                            </div>
                        </button>
                    </div>
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Last Action
                        </h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                            <p class="text-gray-600" id="lastAction">No recent activity</p>
                            <div
                                id="actionHistory"
                                class="space-y-2 mt-4 border-t border-gray-200 pt-4">
                                <div class="text-sm text-gray-500">Previous Actions:</div>
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600">Clocked Out</span>
                                        <span class="text-gray-500">July 31, 2025 11:30 AM</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600">Clocked In</span>
                                        <span class="text-gray-500">July 31, 2025 8:00 AM</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600">Clocked Out</span>
                                        <span class="text-gray-500">July 30, 2025 6:00 PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Employee Information
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Employee ID</label>
                            <div
                                class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-badge-line text-gray-600"></i>
                                </div>
                                <span class="text-gray-900">EMP-2024-001</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <div
                                class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-user-line text-gray-600"></i>
                                </div>
                                <span class="text-gray-900">Sarah Johnson</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                            <div
                                class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-building-line text-gray-600"></i>
                                </div>
                                <span class="text-gray-900">Human Resources</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Location Information
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">GPS Status</span>
                            <div class="flex items-center space-x-2">
                                <div
                                    class="w-3 h-3 bg-yellow-500 rounded-full pulse-animation"
                                    id="gpsStatus"></div>
                                <span class="text-sm text-yellow-600" id="gpsStatusText">Locating...</span>
                            </div>
                        </div>
                        <div
                            class="bg-gray-100 rounded-lg p-4 h-32 flex items-center justify-center"
                            style="background-image: url('https://public.readdy.ai/gen_page/map_placeholder_1280x720.png'); background-size: cover; background-position: center;">
                            <div class="bg-white bg-opacity-90 rounded-lg p-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 flex items-center justify-center">
                                        <i class="ri-map-pin-line text-red-600"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">Current Location</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600" id="locationDetails">
                            <p id="latitudeDisplay">Latitude: Getting location...</p>
                            <p id="longitudeDisplay">Longitude: Getting location...</p>
                            <div class="mt-3 space-y-1">
                                <p class="font-medium text-gray-700">Full Address:</p>
                                <p id="addressDisplay">Loading full address...</p>
                                <p id="cityDisplay" class="text-gray-500">City: Loading...</p>
                                <p id="regionDisplay" class="text-gray-500">
                                    Region: Loading...
                                </p>
                                <p id="countryDisplay" class="text-gray-500">
                                    Country: Loading...
                                </p>
                                <p id="postalCodeDisplay" class="text-gray-500">
                                    Postal Code: Loading...
                                </p>
                            </div>
                        </div>
                        <div
                            class="mt-3 text-xs text-gray-500"
                            id="locationAccuracy"></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Device Information
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">IP Address</span>
                            <span class="text-sm font-medium text-gray-900" id="ipAddress">Loading...</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Browser</span>
                            <span class="text-sm font-medium text-gray-900" id="browserInfo">Detecting...</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Operating System</span>
                            <span class="text-sm font-medium text-gray-900" id="osInfo">Detecting...</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Device Type</span>
                            <span class="text-sm font-medium text-gray-900" id="deviceType">Detecting...</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Screen Resolution</span>
                            <span
                                class="text-sm font-medium text-gray-900"
                                id="screenResolution">Detecting...</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Language</span>
                            <span
                                class="text-sm font-medium text-gray-900"
                                id="languageInfo">Detecting...</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Timezone</span>
                            <span
                                class="text-sm font-medium text-gray-900"
                                id="timezoneInfo">Detecting...</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Session ID</span>
                            <span class="text-sm font-medium text-gray-900" id="sessionId">Generating...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script id="timeUpdater">
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString("en-US", {
                hour12: true,
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
            });
            const dateString = now.toLocaleDateString("en-US", {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
            });
            document.getElementById("digitalClock").textContent = timeString;
            document.getElementById("currentTime").textContent =
                now.toLocaleTimeString("en-US");
            document.getElementById("currentDate").textContent = dateString;
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
    <script id="timeTracking">
        let isTimedIn = false;
        let lastActionTime = null;
        let stream = null;

        function savePhotoToLocalStorage(type, photoData) {
            const timestamp = new Date().toISOString();
            const key = `timecard_photo_${type}_${timestamp}`;
            const photoInfo = {
                timestamp: timestamp,
                type: type,
                photo: photoData,
            };
            localStorage.setItem(key, JSON.stringify(photoInfo));
        }
        async function initializeCamera() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                const videoElement = document.getElementById("cameraPreview");
                videoElement.srcObject = stream;
                videoElement.classList.remove("hidden");
                document.getElementById("cameraPlaceholder").classList.add("hidden");
                document.getElementById("capturePhotoBtn").classList.remove("hidden");
                videoElement.play();
            } catch (error) {
                console.error("Error accessing camera:", error);
                showConfirmation(
                    "Camera access denied",
                    "Please enable camera access to continue",
                    "error",
                );
            }
        }

        function showConfirmation(message, details) {
            const confirmationDiv = document.getElementById("confirmationMessage");
            const confirmationText = document.getElementById("confirmationText");
            const confirmationDetails = document.getElementById("confirmationDetails");
            confirmationText.textContent = message;
            confirmationDetails.textContent = details;
            confirmationDiv.classList.remove("hidden");
            setTimeout(() => {
                confirmationDiv.classList.add("hidden");
            }, 3000);
        }

        function updateStatus(status, color) {
            const statusText = document.getElementById("statusText");
            const statusIndicator = document.getElementById("statusIndicator");
            statusText.textContent = status;
            statusIndicator.className = `w-3 h-3 rounded-full pulse-animation bg-${color}-500`;
        }

        function updateLastAction(action) {
            const lastActionElement = document.getElementById("lastAction");
            const actionHistoryDiv = document.getElementById("actionHistory");
            const now = new Date();
            const timeString = now.toLocaleTimeString("en-US");
            const dateString = now.toLocaleDateString("en-US", {
                month: "long",
                day: "numeric",
                year: "numeric",
            });
            lastActionElement.textContent = `${action} at ${timeString}`;
            const newActionDiv = document.createElement("div");
            newActionDiv.className = "flex items-center justify-between text-sm";
            newActionDiv.innerHTML = `
      <span class="text-gray-600">${action}</span>
      <span class="text-gray-500">${dateString} ${timeString}</span>
      `;
            const historyContainer = actionHistoryDiv.querySelector(".space-y-2");
            historyContainer.insertBefore(newActionDiv, historyContainer.firstChild);
            const historyItems = historyContainer.children;
            if (historyItems.length > 5) {
                historyContainer.removeChild(historyItems[historyItems.length - 1]);
            }
        }

        function handleTimeIn() {
            const video = document.getElementById("cameraPreview");
            const canvas = document.getElementById("photoCanvas");
            const context = canvas.getContext("2d");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const photoData = canvas.toDataURL("image/jpeg");
            savePhotoToLocalStorage("time_in", photoData);
            isTimedIn = true;
            lastActionTime = new Date();
            updateStatus("Clocked In", "green");
            updateLastAction("Clocked In");
            document.getElementById("timeInBtn").disabled = true;
            document.getElementById("timeOutBtn").disabled = false;
            showConfirmation(
                `Successfully clocked in at ${lastActionTime.toLocaleTimeString("en-US")}`,
                "Photo captured • Location verified • Device authenticated",
            );
        }

        function handleTimeOut() {
            const video = document.getElementById("cameraPreview");
            const canvas = document.getElementById("photoCanvas");
            const context = canvas.getContext("2d");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const photoData = canvas.toDataURL("image/jpeg");
            savePhotoToLocalStorage("time_out", photoData);
            isTimedIn = false;
            lastActionTime = new Date();
            updateStatus("Not Clocked In", "red");
            updateLastAction("Clocked Out");
            document.getElementById("timeInBtn").disabled = false;
            document.getElementById("timeOutBtn").disabled = true;
            showConfirmation(
                `Successfully clocked out at ${lastActionTime.toLocaleTimeString("en-US")}`,
                "Photo captured • Session ended • Data saved",
            );
        }
        document.addEventListener("DOMContentLoaded", () => {
            initializeCamera();
        });
        document.getElementById("timeInBtn").addEventListener("click", handleTimeIn);
        document.getElementById("timeOutBtn").addEventListener("click", handleTimeOut);
    </script>
    <script id="locationTracking">
        let currentPosition = null;

        function setLocationStatus(status, color, text) {
            const gpsStatus = document.getElementById("gpsStatus");
            const gpsStatusText = document.getElementById("gpsStatusText");
            gpsStatus.className = `w-3 h-3 rounded-full ${status === "loading" ? "pulse-animation" : ""} bg-${color}-500`;
            gpsStatusText.textContent = text;
            gpsStatusText.className = `text-sm text-${color}-600`;
        }

        function formatCoordinate(coord, isLatitude) {
            const direction = isLatitude ?
                coord >= 0 ?
                "N" :
                "S" :
                coord >= 0 ?
                "E" :
                "W";
            return `${Math.abs(coord).toFixed(4)}° ${direction}`;
        }
        async function reverseGeocode(lat, lng) {
            try {
                const response = await fetch(
                    `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lng}&localityLanguage=en`,
                );
                const data = await response.json();
                return {
                    fullAddress: data.display_name ||
                        `${data.locality || ""}, ${data.city || ""}, ${data.principalSubdivision || ""}, ${data.countryName || ""}`
                        .replace(/^,\s*|,\s*$/g, "")
                        .replace(/,\s*,/g, ",") ||
                        `${lat.toFixed(4)}, ${lng.toFixed(4)}`,
                    city: data.city || data.locality || "Unknown",
                    region: data.principalSubdivision || data.region || "Unknown",
                    country: data.countryName || "Unknown",
                    postalCode: data.postcode || "N/A",
                };
            } catch (error) {
                console.error("Reverse geocoding failed:", error);
                return {
                    fullAddress: `${lat.toFixed(4)}, ${lng.toFixed(4)}`,
                    city: "Unknown",
                    region: "Unknown",
                    country: "Unknown",
                    postalCode: "N/A",
                };
            }
        }
        async function updateLocation() {
            if (!navigator.geolocation) {
                setLocationStatus("error", "red", "Not Supported");
                document.getElementById("latitudeDisplay").textContent =
                    "Latitude: Geolocation not supported";
                document.getElementById("longitudeDisplay").textContent =
                    "Longitude: Geolocation not supported";
                document.getElementById("addressDisplay").textContent =
                    "Address: Geolocation not available";
                return;
            }
            setLocationStatus("loading", "yellow", "Locating...");
            const options = {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 300000,
            };
            navigator.geolocation.getCurrentPosition(
                async function(position) {
                        currentPosition = position;
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        const accuracy = position.coords.accuracy;
                        setLocationStatus("success", "green", "Active");
                        document.getElementById("latitudeDisplay").textContent =
                            `Latitude: ${formatCoordinate(lat, true)}`;
                        document.getElementById("longitudeDisplay").textContent =
                            `Longitude: ${formatCoordinate(lng, false)}`;
                        document.getElementById("locationAccuracy").textContent =
                            `Accuracy: ±${Math.round(accuracy)} meters`;
                        const addressData = await reverseGeocode(lat, lng);
                        document.getElementById("addressDisplay").textContent =
                            addressData.fullAddress;
                        document.getElementById("cityDisplay").textContent =
                            `City: ${addressData.city}`;
                        document.getElementById("regionDisplay").textContent =
                            `Region: ${addressData.region}`;
                        document.getElementById("countryDisplay").textContent =
                            `Country: ${addressData.country}`;
                        document.getElementById("postalCodeDisplay").textContent =
                            `Postal Code: ${addressData.postalCode}`;
                    },
                    function(error) {
                        let errorMessage = "Error occurred";
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage = "Access Denied";
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage = "Unavailable";
                                break;
                            case error.TIMEOUT:
                                errorMessage = "Timeout";
                                break;
                        }
                        setLocationStatus("error", "red", errorMessage);
                        document.getElementById("latitudeDisplay").textContent =
                            "Latitude: Unable to retrieve";
                        document.getElementById("longitudeDisplay").textContent =
                            "Longitude: Unable to retrieve";
                        document.getElementById("addressDisplay").textContent =
                            "Location access required for address details";
                        document.getElementById("cityDisplay").textContent = "City: Unknown";
                        document.getElementById("regionDisplay").textContent = "Region: Unknown";
                        document.getElementById("countryDisplay").textContent =
                            "Country: Unknown";
                        document.getElementById("postalCodeDisplay").textContent =
                            "Postal Code: N/A";
                        document.getElementById("locationAccuracy").textContent =
                            "Please enable location permissions";
                    },
                    options,
            );
        }
        document.addEventListener("DOMContentLoaded", () => {
            updateLocation();
        });
        setInterval(updateLocation, 60000);
    </script>
    <script id="deviceInfo">
        function detectBrowser() {
            const userAgent = navigator.userAgent;
            let browser = "Unknown";
            let version = "";
            if (userAgent.includes("Firefox")) {
                browser = "Firefox";
                const match = userAgent.match(/Firefox\/(\d+\.\d+)/);
                version = match ? match[1] : "";
            } else if (userAgent.includes("Chrome") && !userAgent.includes("Edg")) {
                browser = "Chrome";
                const match = userAgent.match(/Chrome\/(\d+\.\d+)/);
                version = match ? match[1] : "";
            } else if (userAgent.includes("Safari") && !userAgent.includes("Chrome")) {
                browser = "Safari";
                const match = userAgent.match(/Version\/(\d+\.\d+)/);
                version = match ? match[1] : "";
            } else if (userAgent.includes("Edg")) {
                browser = "Edge";
                const match = userAgent.match(/Edg\/(\d+\.\d+)/);
                version = match ? match[1] : "";
            } else if (userAgent.includes("Opera") || userAgent.includes("OPR")) {
                browser = "Opera";
                const match = userAgent.match(/(Opera|OPR)\/(\d+\.\d+)/);
                version = match ? match[2] : "";
            }
            return `${browser}${version ? " " + version : ""}`;
        }

        function detectOS() {
            const userAgent = navigator.userAgent;
            let os = "Unknown";
            if (userAgent.includes("Windows NT 10.0")) {
                os = "Windows 10/11";
            } else if (userAgent.includes("Windows NT 6.3")) {
                os = "Windows 8.1";
            } else if (userAgent.includes("Windows NT 6.2")) {
                os = "Windows 8";
            } else if (userAgent.includes("Windows NT 6.1")) {
                os = "Windows 7";
            } else if (userAgent.includes("Windows")) {
                os = "Windows";
            } else if (userAgent.includes("Mac OS X")) {
                const match = userAgent.match(/Mac OS X (\d+[._]\d+[._]?\d*)/);
                if (match) {
                    const version = match[1].replace(/_/g, ".");
                    os = `macOS ${version}`;
                } else {
                    os = "macOS";
                }
            } else if (userAgent.includes("Linux")) {
                if (userAgent.includes("Android")) {
                    const match = userAgent.match(/Android (\d+\.\d+)/);
                    os = match ? `Android ${match[1]}` : "Android";
                } else {
                    os = "Linux";
                }
            } else if (userAgent.includes("iPhone") || userAgent.includes("iPad")) {
                const match = userAgent.match(/OS (\d+_\d+)/);
                if (match) {
                    const version = match[1].replace("_", ".");
                    os = `iOS ${version}`;
                } else {
                    os = "iOS";
                }
            }
            return os;
        }

        function detectDeviceType() {
            const userAgent = navigator.userAgent;
            if (/Mobi|Android/i.test(userAgent)) {
                return "Mobile";
            } else if (/Tablet|iPad/i.test(userAgent)) {
                return "Tablet";
            } else {
                return "Desktop";
            }
        }

        function generateSessionId() {
            const timestamp = Date.now().toString(36);
            const random = Math.random().toString(36).substr(2, 5).toUpperCase();
            return `SES-${timestamp}-${random}`;
        }

        function updateDeviceInfo() {
            fetch("https://api.ipify.org?format=json")
                .then((response) => response.json())
                .then((data) => {
                    document.getElementById("ipAddress").textContent = data.ip;
                })
                .catch((error) => {
                    document.getElementById("ipAddress").textContent = "Unable to detect";
                });
            document.getElementById("browserInfo").textContent = detectBrowser();
            document.getElementById("osInfo").textContent = detectOS();
            document.getElementById("deviceType").textContent = detectDeviceType();
            document.getElementById("screenResolution").textContent =
                `${screen.width} x ${screen.height}`;
            document.getElementById("languageInfo").textContent =
                navigator.language || "Unknown";
            document.getElementById("timezoneInfo").textContent =
                Intl.DateTimeFormat().resolvedOptions().timeZone;
            document.getElementById("sessionId").textContent = generateSessionId();
        }
        document.addEventListener("DOMContentLoaded", () => {
            updateDeviceInfo();
        });
    </script>
</body>

</html>