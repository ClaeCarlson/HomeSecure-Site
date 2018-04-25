#!/usr/bin/python3.5
#Bryce Renninger 04/20/18 
#Playing a sound file when it is called upon

import pygame
import time

pygame.init()
pygame.mixer.init()
mysound = pygame.mixer.Sound("/var/www/html/sounds/DoorAlarm.wav")
mysound.play()
time.sleep(5)
mysound.stop()
