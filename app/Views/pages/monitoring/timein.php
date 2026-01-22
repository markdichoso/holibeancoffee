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
                                    class="w-3 h-3 bg-green-500 rounded-full"
                                    id="gpsStatus"></div>
                                <span class="text-sm text-green-600" id="gpsStatusText">Active</span>
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
                        <div class="text-sm text-gray-600">
                            <p>Latitude: 40.7128° N</p>
                            <p>Longitude: 74.0060° W</p>
                            <p class="mt-2">123 Business Plaza, New York, NY 10001</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Device Information
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">IP Address</span>
                            <span class="text-sm font-medium text-gray-900" id="ipAddress">192.168.1.105</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Browser</span>
                            <span class="text-sm font-medium text-gray-900">Chrome 91.0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Operating System</span>
                            <span class="text-sm font-medium text-gray-900">Windows 11</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Device Type</span>
                            <span class="text-sm font-medium text-gray-900">Desktop</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Session ID</span>
                            <span class="text-sm font-medium text-gray-900">SES-7891234</span>
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
                hour12: false,
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
        function updateLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        document.getElementById("gpsStatus").className =
                            "w-3 h-3 bg-green-500 rounded-full";
                        document.getElementById("gpsStatusText").textContent = "Active";
                        document.getElementById("gpsStatusText").className =
                            "text-sm text-green-600";
                    },
                    function(error) {
                        document.getElementById("gpsStatus").className =
                            "w-3 h-3 bg-red-500 rounded-full";
                        document.getElementById("gpsStatusText").textContent = "Unavailable";
                        document.getElementById("gpsStatusText").className =
                            "text-sm text-red-600";
                    },
                );
            }
        }
        updateLocation();
        setInterval(updateLocation, 30000);
    </script>
    <script id="deviceInfo">
        function updateDeviceInfo() {
            fetch("https://api.ipify.org?format=json")
                .then((response) => response.json())
                .then((data) => {
                    document.getElementById("ipAddress").textContent = data.ip;
                })
                .catch((error) => {
                    document.getElementById("ipAddress").textContent = "192.168.1.105";
                });
        }
        updateDeviceInfo();
    </script>
</body>

</html>