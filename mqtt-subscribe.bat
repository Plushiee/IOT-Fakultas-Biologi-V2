@echo off
:START
echo Starting MQTT Subscriber...
php artisan mqtt:subscribe

REM
if %errorlevel% neq 0 (
    echo An error occurred. Restarting MQTT Subscriber...
    timeout /t 5 >nul
    goto START
)

REM
echo MQTT Subscriber stopped.
pause
