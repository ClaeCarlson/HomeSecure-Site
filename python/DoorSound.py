#!/usr/bin/python3.5

import pygame
import time

pygame.init()
pygame.mixer.init()
mysound = pygame.mixer.Sound("/var/www/html/sounds/DoorAlarm.wav")
mysound.play()
time.sleep(5)
mysound.stop()
