#!/usr/bin/python
# G. Oij 6/2/2014
# First converts degrees to pulse width
import sys
if len (sys.argv) != 2 :
    print "Usage: python aim.py DEGREES_TO_AIM"
    sys.exit (1)

DEGREES = float(sys.argv[1])

# This formula converts the number of degrees (0 - 180) that these
# servo motors can rotate to a pulse width that will move the
# aiming servo appropriately.

# 2.5% of 20ms is .5ms or 500 microseconds.  This pulse width will
# move the servo motor to 0 degrees.

# 7.5% of 20ms is 1.5ms.  This pulse width will move the servo to 90 degrees.

# 12.5% of 20ms is 2.5ms.  This pulse width will move the servo to 180 degrees.

PULSEWIDTH = ((DEGREES/18) + 2.5)
#print DEGREES
#print " was converted to pulse width of %.2f milliseconds." % (20 * PULSEWIDTH / 100)


import RPi.GPIO as GPIO
import time
#
# The towerpro servo motor moves based on duration of pulses sent to it.
# This illustration shows how to rotate the motor at 90 degree increments.


GPIO.setwarnings(False)

GPIO.setmode(GPIO.BOARD)

# Use Pin 10 as output to control the horizontal servo motor
SERVOPIN=22
GPIO.setup(SERVOPIN,GPIO.OUT)
DELAY=.2

#LED=23

#GPIO.setup(LED,GPIO.OUT)

# Blink the LED for a little drama
#GPIO.output(LED,GPIO.HIGH)
#time.sleep(DELAY)
#GPIO.output(LED,GPIO.LOW)
#time.sleep(DELAY)
#GPIO.output(LED,GPIO.HIGH)
#time.sleep(DELAY)
#GPIO.output(LED,GPIO.LOW)

# Use the Pulse Width Modulation at 20ms (1/50)
# using the .PWM method of the GPIO class
pwmObj = GPIO.PWM(SERVOPIN,50)

# Use 2.5% of 20ms as zero degrees
# Use 12.5% of 20ms as 180 degrees
START=2.5
pwmObj.start(START)

#time.sleep(DELAY)
pwmObj.ChangeDutyCycle(PULSEWIDTH)
time.sleep(DELAY)
GPIO.cleanup()
