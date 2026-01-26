<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Time Tracking System</title>
    <script src="https://cdn.tailwindcss.com/3.4.16">
    </script>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">
        <div id="confirmationMessage" class="hidden mb-6 p-4 bg-green-50 border border-green-200 rounded-lg success-fade">
            <div class="flex items-center">
                <div class="w-6 h-6 flex items-center justify-center mr-3">
                    <i class="ri-check-circle-line text-green-600"></i>
                </div>
                <div>
                    <p class="text-green-800 font-medium" id="confirmationText">Successfully clocked in at 2:30:45 PM</p>
                    <p class="text-green-600 text-sm" id="confirmationDetails">Location verified • Device authenticated</p>
                </div>
            </div>
        </div>
        <div class="max-w-4xl mx-auto">
            <div>
                <div class="bg-gradient-to-br from-white to-blue-50/20 rounded-3xl shadow-2xl border-0 overflow-hidden backdrop-blur-sm">
                    <div class="bg-gradient-to-r from-indigo-500/10 via-purple-500/5 to-pink-500/10 px-4 sm:px-6 lg:px-8 py-6 sm:py-7 lg:py-8 border-b border-gray-100/30">
                        <div class="flex flex-col sm:flex-row items-center sm:justify-between space-y-4 sm:space-y-0">
                            <div class="flex flex-col sm:flex-row items-center sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 lg:space-x-5 text-center sm:text-left">
                                <div class="w-16 h-16 sm:w-18 sm:h-18 lg:w-20 lg:h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl sm:rounded-3xl flex items-center justify-center shadow-2xl">
                                    <div class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 flex items-center justify-center">
                                        <i class="ri-user-line text-white text-2xl sm:text-2xl lg:text-3xl"></i>
                                    </div>
                                </div>
                                <div>
                                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-1">Sarah Johnson</h2>
                                    <p class="text-sm sm:text-base text-gray-600 font-medium">EMP-2024-001 • Human Resources</p>
                                    <p class="text-xs sm:text-sm text-gray-500 mt-1 sm:mt-2 font-medium" id="currentDate">Monday, January 26, 2026</p>
                                </div>
                            </div>
                            <div class="flex justify-center sm:justify-end">
                                <div class="flex items-center space-x-3 sm:space-x-4 px-4 sm:px-5 lg:px-6 py-2 sm:py-3 bg-white/80 backdrop-blur-md rounded-xl sm:rounded-2xl shadow-lg border border-white/20">
                                    <div class="w-3 h-3 sm:w-4 sm:h-4 bg-red-500 rounded-full pulse-animation shadow-lg" id="statusIndicator"></div>
                                    <span class="text-sm sm:text-base font-bold text-gray-800" id="statusText">Not Clocked In</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="bg-gradient-to-br from-white/80 to-gray-50/50 rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 border border-gray-100/50 shadow-xl backdrop-blur-sm mb-6 sm:mb-8">
                            <div class="flex items-center justify-center mb-6 sm:mb-8">
                                <div class="bg-white rounded-xl sm:rounded-2xl p-1 sm:p-2 shadow-lg border border-gray-100/50 w-full max-w-4xl overflow-x-auto">
                                    <div class="flex space-x-1 min-w-max sm:min-w-0 sm:grid sm:grid-cols-5 sm:gap-1" role="tablist">
                                        <button id="timeTab" class="tab-button px-3 sm:px-4 lg:px-6 py-2 sm:py-3 text-xs sm:text-sm font-bold rounded-full transition-all duration-300 !rounded-full bg-primary text-white shadow-md whitespace-nowrap" role="tab" aria-selected="true">
                                            <div class="flex items-center space-x-1 sm:space-x-2">
                                                <div class="w-3 h-3 sm:w-4 sm:h-4 flex items-center justify-center">
                                                    <i class="ri-time-line"></i>
                                                </div>
                                                <span class="hidden sm:inline">Time Tracking</span>
                                                <span class="sm:hidden">Time</span>
                                            </div>
                                        </button>
                                        <button id="logsTab" class="tab-button px-3 sm:px-4 lg:px-6 py-2 sm:py-3 text-xs sm:text-sm font-bold rounded-full transition-all duration-300 !rounded-full text-gray-600 hover:text-gray-800 hover:bg-gray-50 whitespace-nowrap" role="tab" aria-selected="false">
                                            <div class="flex items-center space-x-1 sm:space-x-2">
                                                <div class="w-3 h-3 sm:w-4 sm:h-4 flex items-center justify-center">
                                                    <i class="ri-timer-line"></i>
                                                </div>
                                                <span class="hidden sm:inline">Duration Logs</span>
                                                <span class="sm:hidden">Logs</span>
                                            </div>
                                        </button>
                                        <button id="activityTab" class="tab-button px-3 sm:px-4 lg:px-6 py-2 sm:py-3 text-xs sm:text-sm font-bold rounded-full transition-all duration-300 !rounded-full text-gray-600 hover:text-gray-800 hover:bg-gray-50 whitespace-nowrap" role="tab" aria-selected="false">
                                            <div class="flex items-center space-x-1 sm:space-x-2">
                                                <div class="w-3 h-3 sm:w-4 sm:h-4 flex items-center justify-center">
                                                    <i class="ri-history-line"></i>
                                                </div>
                                                <span>Activity</span>
                                            </div>
                                        </button>
                                        <button id="deviceTab" class="tab-button px-3 sm:px-4 lg:px-6 py-2 sm:py-3 text-xs sm:text-sm font-bold rounded-full transition-all duration-300 !rounded-full text-gray-600 hover:text-gray-800 hover:bg-gray-50 whitespace-nowrap" role="tab" aria-selected="false">
                                            <div class="flex items-center space-x-1 sm:space-x-2">
                                                <div class="w-3 h-3 sm:w-4 sm:h-4 flex items-center justify-center">
                                                    <i class="ri-smartphone-line"></i>
                                                </div>
                                                <span>Device</span>
                                            </div>
                                        </button>
                                        <button id="locationTab" class="tab-button px-3 sm:px-4 lg:px-6 py-2 sm:py-3 text-xs sm:text-sm font-bold rounded-full transition-all duration-300 !rounded-full text-gray-600 hover:text-gray-800 hover:bg-gray-50 whitespace-nowrap" role="tab" aria-selected="false">
                                            <div class="flex items-center space-x-1 sm:space-x-2">
                                                <div class="w-3 h-3 sm:w-4 sm:h-4 flex items-center justify-center">
                                                    <i class="ri-map-pin-line"></i>
                                                </div>
                                                <span>Location</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="timeContent" class="tab-content">
                            <div class="text-center mb-8 sm:mb-10 lg:mb-12 bg-gradient-to-br from-gray-50 to-blue-50/30 rounded-2xl sm:rounded-3xl py-8 sm:py-10 lg:py-12 px-4 sm:px-6 lg:px-8 border border-gray-100/50">
                                <div class="mb-4 sm:mb-6">
                                    <div class="inline-flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl sm:rounded-2xl shadow-xl mb-3 sm:mb-4">
                                        <div class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 flex items-center justify-center">
                                            <i class="ri-time-line text-white text-lg sm:text-xl lg:text-2xl"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-4xl sm:text-6xl lg:text-8xl font-mono font-bold bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent mb-3 sm:mb-4 tracking-tight" id="digitalClock">2:30:45</div>
                                <div class="text-base sm:text-lg lg:text-xl text-gray-600 font-semibold">Live Time</div>
                            </div>
                            <div class="mb-8 sm:mb-10">
                                <div class="bg-gradient-to-br from-gray-900/5 to-indigo-900/10 rounded-2xl sm:rounded-3xl p-3 sm:p-4 lg:p-6 shadow-2xl border border-gray-100/50">
                                    <div class="relative group aspect-[3/4] max-w-md mx-auto">
                                        <video id="cameraPreview" class="w-full h-full object-cover rounded-xl sm:rounded-2xl shadow-2xl border-2 sm:border-4 border-white/50" autoplay playsinline></video>
                                        <canvas id="photoCanvas" class="w-full h-full object-cover rounded-xl sm:rounded-2xl hidden absolute top-0 left-0 shadow-2xl border-2 sm:border-4 border-white/50"></canvas>
                                        <div class="absolute inset-0 rounded-xl sm:rounded-2xl ring-1 ring-black/5 pointer-events-none"></div>
                                        <div class="absolute bottom-2 sm:bottom-3 lg:bottom-4 left-2 sm:left-3 lg:left-4 right-2 sm:right-3 lg:right-4">
                                            <div class="bg-black/40 backdrop-blur-md rounded-xl sm:rounded-2xl px-3 sm:px-4 py-2 sm:py-3">
                                                <div class="flex items-center justify-center space-x-2 sm:space-x-3">
                                                    <div class="w-2 h-2 sm:w-3 sm:h-3 bg-green-400 rounded-full animate-pulse shadow-lg"></div>
                                                    <span class="text-white text-xs sm:text-sm font-bold">Camera Active</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 lg:space-x-8 mb-8 sm:mb-10 lg:mb-12">
                                <button id="timeInBtn" class="group flex-1 bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-bold py-4 sm:py-5 lg:py-6 px-6 sm:px-8 lg:px-10 !rounded-button transition-all duration-300 transform hover:scale-[1.02] hover:-translate-y-1 shadow-2xl hover:shadow-3xl whitespace-nowrap relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <div class="flex items-center justify-center space-x-3 sm:space-x-4 relative z-10">
                                        <div class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 flex items-center justify-center bg-white/20 rounded-lg sm:rounded-xl shadow-lg">
                                            <i class="ri-login-circle-line text-base sm:text-lg lg:text-xl"></i>
                                        </div>
                                        <span class="text-base sm:text-lg lg:text-xl font-bold">Clock In</span>
                                    </div>
                                </button>
                                <button id="timeOutBtn" class="group flex-1 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-bold py-4 sm:py-5 lg:py-6 px-6 sm:px-8 lg:px-10 !rounded-button transition-all duration-300 transform hover:scale-[1.02] hover:-translate-y-1 shadow-2xl hover:shadow-3xl whitespace-nowrap disabled:opacity-40 disabled:cursor-not-allowed disabled:transform-none disabled:shadow-lg relative overflow-hidden" disabled>
                                    <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <div class="flex items-center justify-center space-x-3 sm:space-x-4 relative z-10">
                                        <div class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 flex items-center justify-center bg-white/20 rounded-lg sm:rounded-xl shadow-lg">
                                            <i class="ri-logout-circle-line text-base sm:text-lg lg:text-xl"></i>
                                        </div>
                                        <span class="text-base sm:text-lg lg:text-xl font-bold">Clock Out</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div id="logsContent" class="tab-content hidden">
                            <div class="bg-gradient-to-br from-gray-50 to-orange-50/30 rounded-3xl p-8 border border-gray-100/50 shadow-2xl">
                                <div class="flex items-center justify-between mb-8">
                                    <h3 class="text-3xl font-bold text-gray-900 flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-600 rounded-2xl flex items-center justify-center shadow-xl">
                                            <div class="w-5 h-5 flex items-center justify-center">
                                                <i class="ri-timer-line text-white text-lg"></i>
                                            </div>
                                        </div>
                                        <span>Time Duration Logs</span>
                                    </h3>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-orange-500 rounded-full animate-pulse shadow-lg"></div>
                                        <span class="text-base font-bold text-orange-700">Real-time Tracking</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100/50 shadow-lg hover:shadow-xl transition-shadow">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-blue-100 rounded-xl flex items-center justify-center">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-calendar-line text-blue-600"></i>
                                                    </div>
                                                </div>
                                                <span class="text-lg font-bold text-blue-900">Daily Time</span>
                                            </div>
                                            <div class="w-2 h-2 bg-blue-500 rounded-full shadow-lg"></div>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="text-center">
                                                <div class="text-4xl font-bold text-blue-900 mb-2" id="dailyHours">0h 0m</div>
                                                <div class="text-sm text-blue-700 font-medium">Today's Total</div>
                                            </div>
                                            <div class="bg-white/70 rounded-xl p-3 border border-blue-100/50">
                                                <div class="flex justify-between items-center text-sm">
                                                    <span class="text-gray-700 font-medium">Target</span>
                                                    <span class="text-gray-600">8h 0m</span>
                                                </div>
                                                <div class="w-full bg-blue-100 rounded-full h-2 mt-2">
                                                    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2 rounded-full transition-all duration-500" id="dailyProgress" style="width: 0%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100/50 shadow-lg hover:shadow-xl transition-shadow">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-green-100 rounded-xl flex items-center justify-center">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-calendar-week-line text-green-600"></i>
                                                    </div>
                                                </div>
                                                <span class="text-lg font-bold text-green-900">Weekly Time</span>
                                            </div>
                                            <div class="w-2 h-2 bg-green-500 rounded-full shadow-lg"></div>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="text-center">
                                                <div class="text-4xl font-bold text-green-900 mb-2" id="weeklyHours">32h 45m</div>
                                                <div class="text-sm text-green-700 font-medium">This Week's Total</div>
                                            </div>
                                            <div class="bg-white/70 rounded-xl p-3 border border-green-100/50">
                                                <div class="flex justify-between items-center text-sm">
                                                    <span class="text-gray-700 font-medium">Target</span>
                                                    <span class="text-gray-600">40h 0m</span>
                                                </div>
                                                <div class="w-full bg-green-100 rounded-full h-2 mt-2">
                                                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full transition-all duration-500" style="width: 82%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100/50 shadow-lg hover:shadow-xl transition-shadow">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-purple-100 rounded-xl flex items-center justify-center">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-calendar-2-line text-purple-600"></i>
                                                    </div>
                                                </div>
                                                <span class="text-lg font-bold text-purple-900">Monthly Time</span>
                                            </div>
                                            <div class="w-2 h-2 bg-purple-500 rounded-full shadow-lg"></div>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="text-center">
                                                <div class="text-4xl font-bold text-purple-900 mb-2" id="monthlyHours">138h 20m</div>
                                                <div class="text-sm text-purple-700 font-medium">January 2026 Total</div>
                                            </div>
                                            <div class="bg-white/70 rounded-xl p-3 border border-purple-100/50">
                                                <div class="flex justify-between items-center text-sm">
                                                    <span class="text-gray-700 font-medium">Target</span>
                                                    <span class="text-gray-600">160h 0m</span>
                                                </div>
                                                <div class="w-full bg-purple-100 rounded-full h-2 mt-2">
                                                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full transition-all duration-500" style="width: 86%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 bg-gradient-to-r from-orange-50 to-yellow-50 rounded-2xl p-6 border border-orange-100/50 shadow-lg">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-8 h-8 bg-orange-100 rounded-xl flex items-center justify-center">
                                                <div class="w-4 h-4 flex items-center justify-center">
                                                    <i class="ri-information-line text-orange-600"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-bold text-orange-900">Current Status</h4>
                                                <p class="text-sm text-orange-700" id="currentStatusText">Not clocked in • Ready to start tracking</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-2xl font-bold text-orange-900" id="sessionDuration">0h 0m</div>
                                            <div class="text-sm text-orange-700">Current Session</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="activityContent" class="tab-content hidden">
                            <div class="bg-gradient-to-br from-gray-50 to-blue-50/30 rounded-3xl p-8 border border-gray-100/50 shadow-2xl">
                                <div class="flex items-center justify-between mb-8">
                                    <h3 class="text-3xl font-bold text-gray-900 flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-xl">
                                            <div class="w-5 h-5 flex items-center justify-center">
                                                <i class="ri-history-line text-white text-lg"></i>
                                            </div>
                                        </div>
                                        <span>Activity Timeline</span>
                                    </h3>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full animate-bounce shadow-lg"></div>
                                        <span class="text-base font-bold text-gray-700">Live Updates</span>
                                    </div>
                                </div>
                                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-3xl p-6 mb-8 border border-blue-100/50 shadow-lg">
                                    <div class="flex items-center space-x-4 mb-4">
                                        <div class="w-4 h-4 bg-blue-500 rounded-full shadow-lg"></div>
                                        <span class="text-base font-bold text-blue-900">Latest Activity</span>
                                    </div>
                                    <p class="text-gray-800 font-bold text-xl" id="lastAction">No recent activity</p>
                                </div>
                                <div id="actionHistory" class="space-y-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-sm font-medium text-gray-700">Recent Actions</span>
                                        <span class="text-xs text-gray-400">Last 5 entries</span>
                                    </div>
                                    <div class="space-y-4" id="actionHistoryList">
                                        <div class="flex items-center space-x-4 p-4 bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                                            <div class="w-14 h-14 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl overflow-hidden flex-shrink-0">
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-image-line text-gray-400"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-sm font-semibold text-gray-900">Clocked Out</span>
                                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-md">July 31, 2025 11:30 AM</span>
                                                </div>
                                                <p class="text-xs text-gray-500">No photo captured • Session ended</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4 p-4 bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                                            <div class="w-14 h-14 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl overflow-hidden flex-shrink-0">
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-image-line text-gray-400"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-sm font-semibold text-gray-900">Clocked In</span>
                                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-md">July 31, 2025 8:00 AM</span>
                                                </div>
                                                <p class="text-xs text-gray-500">No photo captured • Location verified</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4 p-4 bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                                            <div class="w-14 h-14 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl overflow-hidden flex-shrink-0">
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <div class="w-5 h-5 flex items-center justify-center">
                                                        <i class="ri-image-line text-gray-400"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-sm font-semibold text-gray-900">Clocked Out</span>
                                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-md">July 30, 2025 6:00 PM</span>
                                                </div>
                                                <p class="text-xs text-gray-500">No photo captured • Day completed</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="deviceContent" class="tab-content hidden">
                            <div class="bg-gradient-to-br from-gray-50 to-purple-50/30 rounded-3xl p-8 border border-gray-100/50 shadow-2xl">
                                <div class="flex items-center justify-between mb-8">
                                    <h3 class="text-3xl font-bold text-gray-900 flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                                            <div class="w-5 h-5 flex items-center justify-center">
                                                <i class="ri-smartphone-line text-white text-lg"></i>
                                            </div>
                                        </div>
                                        <span>Device Information</span>
                                    </h3>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse shadow-lg"></div>
                                        <span class="text-sm font-medium text-green-600">Connected</span>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100/50 shadow-lg">
                                        <div class="flex items-center space-x-3 mb-4">
                                            <div class="w-8 h-8 bg-purple-100 rounded-xl flex items-center justify-center">
                                                <div class="w-4 h-4 flex items-center justify-center">
                                                    <i class="ri-global-line text-purple-600"></i>
                                                </div>
                                            </div>
                                            <span class="text-lg font-bold text-purple-900">Network</span>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">IP Address</span>
                                                <span class="text-sm text-gray-600 font-mono bg-white px-3 py-1 rounded-lg" id="ipAddress">Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">Session ID</span>
                                                <span class="text-sm text-gray-600 font-mono bg-white px-3 py-1 rounded-lg" id="sessionId">Generating...</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100/50">
                                        <div class="space-y-4">
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-window-line text-gray-500"></i>
                                                    </div>
                                                    <span>Browser</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="browserInfo">Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-computer-line text-gray-500"></i>
                                                    </div>
                                                    <span>Operating System</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="osInfo">Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-device-line text-gray-500"></i>
                                                    </div>
                                                    <span>Device Type</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="deviceType">Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-aspect-ratio-line text-gray-500"></i>
                                                    </div>
                                                    <span>Screen Resolution</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="screenResolution">Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-translate-line text-gray-500"></i>
                                                    </div>
                                                    <span>Language</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="languageInfo">Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-time-zone-line text-gray-500"></i>
                                                    </div>
                                                    <span>Timezone</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="timezoneInfo">Detecting...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="locationContent" class="tab-content hidden">
                            <div class="bg-gradient-to-br from-gray-50 to-green-50/30 rounded-3xl p-8 border border-gray-100/50 shadow-2xl">
                                <div class="flex items-center justify-between mb-8">
                                    <h3 class="text-3xl font-bold text-gray-900 flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-xl">
                                            <div class="w-5 h-5 flex items-center justify-center">
                                                <i class="ri-map-pin-line text-white text-lg"></i>
                                            </div>
                                        </div>
                                        <span>Location Information</span>
                                    </h3>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 rounded-full shadow-lg pulse-animation" id="gpsStatus"></div>
                                        <span class="text-sm font-medium" id="gpsStatusText">Initializing...</span>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100/50 shadow-lg">
                                        <div class="flex items-center space-x-3 mb-4">
                                            <div class="w-8 h-8 bg-green-100 rounded-xl flex items-center justify-center">
                                                <div class="w-4 h-4 flex items-center justify-center">
                                                    <i class="ri-gps-line text-green-600"></i>
                                                </div>
                                            </div>
                                            <span class="text-lg font-bold text-green-900">GPS Coordinates</span>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700" id="latitudeDisplay">Latitude: Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700" id="longitudeDisplay">Longitude: Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-gray-600" id="locationAccuracy">Accuracy: Calculating...</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100/50">
                                        <div class="space-y-4">
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-building-line text-gray-500"></i>
                                                    </div>
                                                    <span>Building</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="buildingDisplay">Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-road-map-line text-gray-500"></i>
                                                    </div>
                                                    <span>Street</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="streetDisplay">Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-map-2-line text-gray-500"></i>
                                                    </div>
                                                    <span>City</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="cityDisplay">Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-pin-distance-line text-gray-500"></i>
                                                    </div>
                                                    <span>Region</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="regionDisplay">Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-earth-line text-gray-500"></i>
                                                    </div>
                                                    <span>Country</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="countryDisplay">Detecting...</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2">
                                                <span class="text-sm font-medium text-gray-700 flex items-center space-x-2">
                                                    <div class="w-4 h-4 flex items-center justify-center">
                                                        <i class="ri-mail-line text-gray-500"></i>
                                                    </div>
                                                    <span>Postal Code</span>
                                                </span>
                                                <span class="text-sm text-gray-600" id="postalCodeDisplay">Detecting...</span>
                                            </div>
                                        </div>
                                        <div class="mt-6 p-4 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border border-gray-100">
                                            <h4 class="text-sm font-bold text-gray-800 mb-2">Full Address</h4>
                                            <p class="text-sm text-gray-600 leading-relaxed" id="addressDisplay">Retrieving location information...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

        function updateLastAction(action, photoData = null) {
            const lastActionElement = document.getElementById("lastAction");
            const now = new Date();
            const timeString = now.toLocaleTimeString("en-US");
            const dateString = now.toLocaleDateString("en-US", {
                month: "long",
                day: "numeric",
                year: "numeric",
            });
            lastActionElement.textContent = `${action} at ${timeString}`;
            const historyContainer = document.getElementById("actionHistoryList");
            const newActionDiv = document.createElement("div");
            newActionDiv.className =
                "flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-200";
            const photoHtml = photoData ?
                `<img src="${photoData}" class="w-full h-full object-cover rounded-lg" alt="Captured photo">` :
                `<div class="w-full h-full flex items-center justify-center">
<div class="w-4 h-4 flex items-center justify-center">
<i class="ri-image-line text-gray-400"></i>
</div>
</div>`;
            newActionDiv.innerHTML = `
<div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
${photoHtml}
</div>
<div class="flex-1 min-w-0">
<div class="flex items-center justify-between">
<span class="text-sm font-medium text-gray-700">${action}</span>
<span class="text-xs text-gray-500">${dateString} ${timeString}</span>
</div>
<p class="text-xs text-gray-500 mt-1">${photoData ? "Photo captured successfully" : "No photo captured"}</p>
</div>
`;
            historyContainer.insertBefore(newActionDiv, historyContainer.firstChild);
            const historyItems = historyContainer.children;
            if (historyItems.length > 5) {
                historyContainer.removeChild(historyItems[historyItems.length - 1]);
            }
        }

        function handleTimeIn() {
            const video = document.getElementById("cameraPreview");
            const canvas = document.getElementById("photoCanvas");
            if (video.videoWidth === 0 || video.videoHeight === 0) {
                showConfirmation(
                    "Camera not ready",
                    "Please wait for camera to initialize and try again",
                    "error",
                );
                return;
            }
            const context = canvas.getContext("2d");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const photoData = canvas.toDataURL("image/jpeg", 0.8);
            savePhotoToLocalStorage("time_in", photoData);
            isTimedIn = true;
            lastActionTime = new Date();
            updateStatus("Clocked In", "green");
            updateLastAction("Clocked In", photoData);
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
            if (video.videoWidth === 0 || video.videoHeight === 0) {
                showConfirmation(
                    "Camera not ready",
                    "Please wait for camera to initialize and try again",
                    "error",
                );
                return;
            }
            const context = canvas.getContext("2d");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const photoData = canvas.toDataURL("image/jpeg", 0.8);
            savePhotoToLocalStorage("time_out", photoData);
            isTimedIn = false;
            lastActionTime = new Date();
            updateStatus("Not Clocked In", "red");
            updateLastAction("Clocked Out", photoData);
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
                const building =
                    data.building || data.house || data.amenity || "Not available";
                const streetNumber = data.streetNumber || "";
                const streetName = data.streetName || data.road || "";
                const street = `${streetNumber} ${streetName}`.trim() || "Not available";
                const fullAddress =
                    data.display_name ||
                    `${building !== "Not available" ? building + ", " : ""}${street !== "Not available" ? street + ", " : ""}${data.locality || data.city || ""}, ${data.principalSubdivision || ""}, ${data.countryName || ""}`
                    .replace(/^,\s*|,\s*$/g, "")
                    .replace(/,\s*,/g, ",") ||
                    `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                return {
                    building: building,
                    street: street,
                    fullAddress: fullAddress,
                    city: data.city || data.locality || "Unknown",
                    region: data.principalSubdivision || data.region || "Unknown",
                    country: data.countryName || "Unknown",
                    postalCode: data.postcode || "N/A",
                };
            } catch (error) {
                console.error("Reverse geocoding failed:", error);
                return {
                    building: "Not available",
                    street: "Not available",
                    fullAddress: `${lat.toFixed(6)}, ${lng.toFixed(6)}`,
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
                        document.getElementById("buildingDisplay").textContent =
                            `Building: ${addressData.building}`;
                        document.getElementById("streetDisplay").textContent =
                            `Street: ${addressData.street}`;
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
                        document.getElementById("buildingDisplay").textContent =
                            "Building: Access required";
                        document.getElementById("streetDisplay").textContent =
                            "Street: Access required";
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
    <script id="dateUpdater">
        function updateCurrentDate() {
            const now = new Date();
            const dateString = now.toLocaleDateString("en-US", {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
            });
            document.getElementById("currentDate").textContent = dateString;
        }
        document.addEventListener("DOMContentLoaded", () => {
            updateCurrentDate();
        });
        setInterval(updateCurrentDate, 3600000);
    </script>
    <script id="tabNavigation">
        function showTab(tabName) {
            document.querySelectorAll(".tab-content").forEach((content) => {
                content.classList.add("hidden");
            });
            document.querySelectorAll(".tab-button").forEach((button) => {
                button.classList.remove("bg-primary", "text-white", "shadow-md");
                button.classList.add(
                    "text-gray-600",
                    "hover:text-gray-800",
                    "hover:bg-gray-50",
                );
                button.setAttribute("aria-selected", "false");
            });
            document.getElementById(tabName + "Content").classList.remove("hidden");
            document
                .getElementById(tabName + "Tab")
                .classList.remove(
                    "text-gray-600",
                    "hover:text-gray-800",
                    "hover:bg-gray-50",
                );
            document
                .getElementById(tabName + "Tab")
                .classList.add("bg-primary", "text-white", "shadow-md");
            document
                .getElementById(tabName + "Tab")
                .setAttribute("aria-selected", "true");
        }
        document.addEventListener("DOMContentLoaded", () => {
            document
                .getElementById("timeTab")
                .addEventListener("click", () => showTab("time"));
            document
                .getElementById("logsTab")
                .addEventListener("click", () => showTab("logs"));
            document
                .getElementById("activityTab")
                .addEventListener("click", () => showTab("activity"));
            document
                .getElementById("deviceTab")
                .addEventListener("click", () => showTab("device"));
            document
                .getElementById("locationTab")
                .addEventListener("click", () => showTab("location"));
        });
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