#!/usr/bin/python3

import signal
import sys
import json
from time import sleep
from gpiozero import PWMLED

JSON_DATA_FILE="/tmp/.power_led"
LED_DIM_MODE_LAST = "0"
with open(JSON_DATA_FILE) as json_file:
    json_data = json.load(json_file)
POWER_LED = PWMLED(json_data["led_gpio"])


def sigterm_handler(*_):
    for x in range(int(json_data["led_max_brightness"]), 0, -1):
        POWER_LED.value = x/100
        sleep(0.003)
    for x in range(0, int(json_data["led_max_brightness"]), +1):
        POWER_LED.value = x/100
        sleep(0.003)
    for x in range(int(json_data["led_max_brightness"]), 0, -1):
        POWER_LED.value = x/100
        sleep(0.003)
    for x in range(0, int(json_data["led_max_brightness"]), +1):
        POWER_LED.value = x/100
        sleep(0.003)
    for x in range(int(json_data["led_max_brightness"]), 0, -1):
        POWER_LED.value = x/100
        sleep(0.003)
    for x in range(0, int(json_data["led_max_brightness"]), +1):
        POWER_LED.value = x/100
        sleep(0.003)
    for x in range(int(json_data["led_max_brightness"]), 0, -1):
        POWER_LED.value = x/100
        sleep(0.003)
    for x in range(0, int(json_data["led_max_brightness"]), +1):
        POWER_LED.value = x/100
        sleep(0.003)
    for x in range(int(json_data["led_max_brightness"]), 0, -1):
        POWER_LED.value = x/100
        sleep(0.003)
    sys.exit(0)

def init():
    with open(JSON_DATA_FILE) as json_file:
        json_data = json.load(json_file)
    
    for x in range(0, int(json_data["led_max_brightness"])):
        x += 1
        POWER_LED.value = x/100
        sleep(0.1)

def main():
    LED_DIM_MODE_LAST = 0
    while True:
        with open(JSON_DATA_FILE) as json_file:
            json_data = json.load(json_file)
        if json_data["led_dim_mode"] == "0" and json_data["led_dim_mode"] != LED_DIM_MODE_LAST:
            for x in range(int(json_data["led_min_brightness"]), int(json_data["led_max_brightness"]), +1):
                POWER_LED.value = x/100
                sleep(0.02)
        if json_data["led_dim_mode"] == "1" and json_data["led_dim_mode"] != LED_DIM_MODE_LAST:
            for x in range(int(json_data["led_max_brightness"]), int(json_data["led_min_brightness"]), -1):
                POWER_LED.value = x/100
                sleep(0.02)
        LED_DIM_MODE_LAST = json_data["led_dim_mode"]
        sleep(1)

if __name__ == "__main__":
    init()
    signal.signal(signal.SIGTERM, sigterm_handler)
    main()
