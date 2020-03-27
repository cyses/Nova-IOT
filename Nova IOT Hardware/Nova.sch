EESchema Schematic File Version 4
EELAYER 30 0
EELAYER END
$Descr A4 11693 8268
encoding utf-8
Sheet 1 1
Title "Nova"
Date "2019-12-04"
Rev "v1.0"
Comp ""
Comment1 ""
Comment2 ""
Comment3 ""
Comment4 ""
$EndDescr
$Comp
L RF_Module:RFM95W-868S2 U2
U 1 1 5DE64123
P 6900 3150
F 0 "U2" H 6900 3831 50  0000 C CNN
F 1 "RFM95W-868S2" H 6900 3740 50  0000 C CNN
F 2 "RFM95W-868S2:XCVR_RFM95W-868S2" H 3600 4800 50  0001 C CNN
F 3 "https://www.hoperf.com/data/upload/portal/20181127/5bfcbea20e9ef.pdf" H 3600 4800 50  0001 C CNN
	1    6900 3150
	1    0    0    -1  
$EndComp
Wire Wire Line
	1550 2100 1950 2100
Wire Wire Line
	1350 1350 1950 1350
Wire Wire Line
	1950 1350 1950 1400
Text GLabel 1350 1350 0    50   Input ~ 0
RST
Text GLabel 3800 2500 2    50   Input ~ 0
PA0
Text GLabel 3800 2600 2    50   Input ~ 0
PA1
Text GLabel 3800 2700 2    50   Input ~ 0
PA2
Wire Wire Line
	3800 2500 3250 2500
Wire Wire Line
	3250 2600 3800 2600
Wire Wire Line
	3250 2700 3800 2700
Text GLabel 3800 2800 2    50   Input ~ 0
PA3
Text GLabel 3800 2900 2    50   Input ~ 0
PA4
Text GLabel 3800 3000 2    50   Input ~ 0
SCK
Text GLabel 3800 3100 2    50   Input ~ 0
MISO
Text GLabel 3800 3200 2    50   Input ~ 0
MOSI
Wire Wire Line
	3800 2800 3250 2800
Wire Wire Line
	3250 2900 3800 2900
Wire Wire Line
	3800 3000 3250 3000
Wire Wire Line
	3250 3100 3800 3100
Wire Wire Line
	3800 3200 3250 3200
Text GLabel 1550 2500 0    50   Input ~ 0
RESET
Wire Wire Line
	1550 2500 1950 2500
Text GLabel 1550 2600 0    50   Input ~ 0
DIO5
Text GLabel 1550 2700 0    50   Input ~ 0
PB2
Wire Wire Line
	1550 2600 1950 2600
Wire Wire Line
	1950 2700 1550 2700
Text GLabel 1550 3500 0    50   Input ~ 0
DIO1
Text GLabel 1550 3600 0    50   Input ~ 0
DIO2
Wire Wire Line
	1550 3500 1950 3500
Wire Wire Line
	1550 3600 1950 3600
Text GLabel 1550 3700 0    50   Input ~ 0
PB12
Text GLabel 1550 3800 0    50   Input ~ 0
PB13
Text GLabel 1550 3900 0    50   Input ~ 0
PB14
Text GLabel 1550 4000 0    50   Input ~ 0
PB15
Wire Wire Line
	1550 3700 1950 3700
Wire Wire Line
	1950 3800 1550 3800
Wire Wire Line
	1550 3900 1950 3900
Wire Wire Line
	1950 4000 1550 4000
Text GLabel 3800 3300 2    50   Input ~ 0
PA8
Text GLabel 3800 3400 2    50   Input ~ 0
PA9
Text GLabel 3800 3500 2    50   Input ~ 0
PA10
Text GLabel 3800 3600 2    50   Input ~ 0
D_N
Text GLabel 3800 3700 2    50   Input ~ 0
D_P
Text GLabel 3800 3800 2    50   Input ~ 0
PA13
Text GLabel 3800 3900 2    50   Input ~ 0
PA14
Text GLabel 3800 4000 2    50   Input ~ 0
NSS
Wire Wire Line
	3800 3300 3250 3300
Wire Wire Line
	3250 3400 3800 3400
Wire Wire Line
	3800 3500 3250 3500
Wire Wire Line
	3250 3600 3800 3600
Wire Wire Line
	3800 3700 3250 3700
Wire Wire Line
	3250 3800 3800 3800
Wire Wire Line
	3800 3900 3250 3900
Wire Wire Line
	3250 4000 3800 4000
Text GLabel 1550 2800 0    50   Input ~ 0
PB3
Text GLabel 1550 2900 0    50   Input ~ 0
PB4
Text GLabel 1550 3000 0    50   Input ~ 0
PB5
Text GLabel 1550 3100 0    50   Input ~ 0
PB6
Text GLabel 1550 3200 0    50   Input ~ 0
PB7
Text GLabel 1550 3300 0    50   Input ~ 0
DIO3
Text GLabel 1550 3400 0    50   Input ~ 0
DIO4
Wire Wire Line
	1550 3400 1950 3400
Wire Wire Line
	1950 3300 1550 3300
Wire Wire Line
	1550 3200 1950 3200
Wire Wire Line
	1950 3100 1550 3100
Wire Wire Line
	1950 2900 1550 2900
Wire Wire Line
	1550 2800 1950 2800
$Comp
L power:GND #PWR0101
U 1 1 5DE72C38
P 8200 2050
F 0 "#PWR0101" H 8200 1800 50  0001 C CNN
F 1 "GND" H 8205 1877 50  0000 C CNN
F 2 "" H 8200 2050 50  0001 C CNN
F 3 "" H 8200 2050 50  0001 C CNN
	1    8200 2050
	1    0    0    -1  
$EndComp
Text GLabel 6800 4150 3    50   Input ~ 0
GND
Text GLabel 6000 3050 0    50   Input ~ 0
MISO
Text GLabel 6000 3150 0    50   Input ~ 0
NSS
Text GLabel 6000 3350 0    50   Input ~ 0
RESET
Text GLabel 6000 2950 0    50   Input ~ 0
MOSI
Text GLabel 6000 2850 0    50   Input ~ 0
SCK
Wire Wire Line
	6000 2850 6400 2850
Wire Wire Line
	6000 2950 6400 2950
Wire Wire Line
	6400 3050 6000 3050
Wire Wire Line
	6000 3150 6400 3150
Wire Wire Line
	6400 3350 6000 3350
Text GLabel 6900 4150 3    50   Input ~ 0
GND
Text GLabel 7000 4150 3    50   Input ~ 0
GND
Text GLabel 7750 3250 2    50   Input ~ 0
DIO3
Text GLabel 7750 3150 2    50   Input ~ 0
DIO4
Text GLabel 7750 3050 2    50   Input ~ 0
DIO5
Text GLabel 7750 2850 2    50   Input ~ 0
ANT
Text GLabel 7750 3350 2    50   Input ~ 0
DIO2
Text GLabel 7750 3450 2    50   Input ~ 0
DIO1
Text GLabel 7750 3550 2    50   Input ~ 0
DIO0
Wire Wire Line
	7400 2850 7750 2850
Wire Wire Line
	7750 3050 7400 3050
Wire Wire Line
	7400 3150 7750 3150
Wire Wire Line
	7400 3350 7750 3350
Wire Wire Line
	7750 3450 7400 3450
Wire Wire Line
	7400 3550 7750 3550
Wire Wire Line
	2450 1200 2450 1000
Wire Wire Line
	2450 1000 2550 1000
Wire Wire Line
	2650 1000 2650 1200
Text GLabel 2250 750  0    50   Input ~ 0
3V3
Wire Wire Line
	2250 750  2400 750 
Wire Wire Line
	2550 750  2550 1000
Connection ~ 2550 1000
Wire Wire Line
	2550 1000 2650 1000
$Comp
L Device:C_Small C1
U 1 1 5DE89BE7
P 2650 650
F 0 "C1" V 2350 650 50  0000 C CNN
F 1 "0.1uF" V 2529 650 50  0000 C CNN
F 2 "digikey-footprints:0603" H 2650 650 50  0001 C CNN
F 3 "~" H 2650 650 50  0001 C CNN
	1    2650 650 
	0    1    1    0   
$EndComp
Wire Wire Line
	2550 750  2550 650 
Connection ~ 2550 750 
Wire Wire Line
	2650 4200 2750 4200
Wire Wire Line
	4200 4200 4200 1300
Connection ~ 2750 4200
Wire Wire Line
	2750 4200 3750 4200
Text GLabel 4600 1300 2    50   Input ~ 0
GND
Wire Wire Line
	4600 1300 4500 1300
Connection ~ 4200 1300
Wire Wire Line
	4200 1300 4200 650 
Wire Wire Line
	2750 650  4200 650 
Wire Wire Line
	3350 1100 3750 1100
Wire Wire Line
	3150 1000 3550 1000
$Comp
L Device:C_Small C2
U 1 1 5DEA00D7
P 2950 900
F 0 "C2" V 2721 900 50  0000 C CNN
F 1 "0.1uF" V 2812 900 50  0000 C CNN
F 2 "digikey-footprints:0603" H 2950 900 50  0001 C CNN
F 3 "~" H 2950 900 50  0001 C CNN
	1    2950 900 
	0    1    1    0   
$EndComp
Wire Wire Line
	3050 900  3650 900 
Wire Wire Line
	2550 1200 2550 1100
Wire Wire Line
	2550 1100 2600 1100
Wire Wire Line
	2600 1100 2600 900 
Wire Wire Line
	2600 900  2850 900 
Wire Wire Line
	2750 1200 2750 1000
Wire Wire Line
	2750 1000 2950 1000
Wire Wire Line
	2850 1200 2850 1100
Wire Wire Line
	2850 1100 3150 1100
Wire Wire Line
	4200 1300 4100 1300
Wire Wire Line
	4100 1300 4100 900 
Wire Wire Line
	4000 1300 4000 1000
Connection ~ 4100 1300
Wire Wire Line
	4100 1300 4000 1300
Wire Wire Line
	3900 1300 3900 1100
Connection ~ 4000 1300
Wire Wire Line
	4000 1300 3900 1300
Wire Wire Line
	2400 750  2400 900 
Wire Wire Line
	2400 900  2600 900 
Connection ~ 2400 750 
Wire Wire Line
	2400 750  2550 750 
Connection ~ 2600 900 
Wire Wire Line
	2850 900  2750 1000
Connection ~ 2850 900 
Connection ~ 2750 1000
Wire Wire Line
	2850 900  2850 1100
Connection ~ 2850 1100
Wire Wire Line
	3650 900  3650 4650
Wire Wire Line
	3650 4650 2450 4650
Wire Wire Line
	2450 4650 2450 4200
Connection ~ 3650 900 
Wire Wire Line
	3650 900  4100 900 
Wire Wire Line
	3550 1000 3550 4500
Wire Wire Line
	3550 4500 2750 4500
Wire Wire Line
	2750 4500 2750 4200
Connection ~ 3550 1000
Wire Wire Line
	3550 1000 4000 1000
Wire Wire Line
	2550 4200 2650 4200
Wire Wire Line
	3750 4200 3750 1100
Connection ~ 3750 4200
Wire Wire Line
	3750 4200 4200 4200
Connection ~ 2650 4200
Connection ~ 3750 1100
Wire Wire Line
	3750 1100 3900 1100
$Comp
L Device:C_Small C5
U 1 1 5DEC8BCD
P 7000 2050
F 0 "C5" V 6771 2050 50  0000 C CNN
F 1 "0.1uF" V 6862 2050 50  0000 C CNN
F 2 "digikey-footprints:0603" H 7000 2050 50  0001 C CNN
F 3 "~" H 7000 2050 50  0001 C CNN
	1    7000 2050
	0    1    1    0   
$EndComp
Text GLabel 6100 2000 0    50   Input ~ 0
3V3
Wire Wire Line
	6100 2000 6900 2000
Wire Wire Line
	6900 2000 6900 2050
Connection ~ 6900 2050
Wire Wire Line
	6900 2050 6900 2650
Wire Wire Line
	7100 2050 7100 1450
Wire Wire Line
	7100 1450 4500 1450
Wire Wire Line
	4500 1450 4500 1300
Connection ~ 4500 1300
Wire Wire Line
	4500 1300 4200 1300
Wire Wire Line
	7100 1450 8200 1450
Wire Wire Line
	8200 1450 8200 2050
Connection ~ 7100 1450
Text GLabel 1600 1600 0    50   Input ~ 0
BOOT0
Wire Wire Line
	1600 1600 1950 1600
$Comp
L Device:C_Small C6
U 1 1 5DEDDB97
P 1050 2200
F 0 "C6" V 821 2200 50  0000 C CNN
F 1 "10pF" V 912 2200 50  0000 C CNN
F 2 "digikey-footprints:0603" H 1050 2200 50  0001 C CNN
F 3 "~" H 1050 2200 50  0001 C CNN
	1    1050 2200
	0    1    1    0   
$EndComp
Text GLabel 1550 2100 0    50   Input ~ 0
DIO0
Wire Wire Line
	1950 2300 1850 2300
Text GLabel 800  2350 0    50   Input ~ 0
GND
Wire Wire Line
	950  2350 800  2350
Wire Wire Line
	950  2200 950  2350
$Comp
L Device:Crystal Y1
U 1 1 5DF544D5
P 1300 2250
F 0 "Y1" V 1254 2381 50  0000 L CNN
F 1 "32.768Khz" V 1345 2381 50  0000 L CNN
F 2 "digikey-footprints:SMD-2_3.2x1.5mm" H 1300 2250 50  0001 C CNN
F 3 "~" H 1300 2250 50  0001 C CNN
	1    1300 2250
	0    1    1    0   
$EndComp
Connection ~ 950  2350
Wire Wire Line
	1950 2200 1300 2200
Wire Wire Line
	1300 2200 1300 2100
Wire Wire Line
	1150 2200 1300 2200
Connection ~ 1300 2200
Wire Wire Line
	1300 2400 1850 2400
Wire Wire Line
	1850 2400 1850 2300
Connection ~ 1850 2300
Wire Wire Line
	1850 2300 1800 2300
Wire Wire Line
	1150 2350 1300 2350
Wire Wire Line
	1300 2350 1300 2400
Connection ~ 1300 2400
Text GLabel 8400 3250 3    50   Input ~ 0
GND
Text GLabel 8900 2850 2    50   Input ~ 0
ANT
Wire Wire Line
	8900 2850 8600 2850
Wire Wire Line
	8400 3050 8400 3250
$Comp
L Device:R_Small R1
U 1 1 5DFDB179
P 650 7050
F 0 "R1" H 709 7096 50  0000 L CNN
F 1 "10K" H 709 7005 50  0000 L CNN
F 2 "digikey-footprints:0603" H 650 7050 50  0001 C CNN
F 3 "~" H 650 7050 50  0001 C CNN
	1    650  7050
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R2
U 1 1 5DFE2951
P 900 7050
F 0 "R2" H 959 7096 50  0000 L CNN
F 1 "10K" H 959 7005 50  0000 L CNN
F 2 "digikey-footprints:0603" H 900 7050 50  0001 C CNN
F 3 "~" H 900 7050 50  0001 C CNN
	1    900  7050
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R3
U 1 1 5DFE855E
P 1150 7050
F 0 "R3" H 1209 7096 50  0000 L CNN
F 1 "10K" H 1209 7005 50  0000 L CNN
F 2 "digikey-footprints:0603" H 1150 7050 50  0001 C CNN
F 3 "~" H 1150 7050 50  0001 C CNN
	1    1150 7050
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R4
U 1 1 5DFEE12F
P 1400 7050
F 0 "R4" H 1459 7096 50  0000 L CNN
F 1 "10K" H 1459 7005 50  0000 L CNN
F 2 "digikey-footprints:0603" H 1400 7050 50  0001 C CNN
F 3 "~" H 1400 7050 50  0001 C CNN
	1    1400 7050
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R5
U 1 1 5DFF3D5B
P 1650 7050
F 0 "R5" H 1709 7096 50  0000 L CNN
F 1 "4.7K" H 1709 7005 50  0000 L CNN
F 2 "digikey-footprints:0603" H 1650 7050 50  0001 C CNN
F 3 "~" H 1650 7050 50  0001 C CNN
	1    1650 7050
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R6
U 1 1 5DFF9930
P 1900 7050
F 0 "R6" H 1959 7096 50  0000 L CNN
F 1 "10K" H 1959 7005 50  0000 L CNN
F 2 "digikey-footprints:0603" H 1900 7050 50  0001 C CNN
F 3 "~" H 1900 7050 50  0001 C CNN
	1    1900 7050
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R7
U 1 1 5DFFF4F3
P 2150 7050
F 0 "R7" H 2209 7096 50  0000 L CNN
F 1 "10K" H 2209 7005 50  0000 L CNN
F 2 "digikey-footprints:0603" H 2150 7050 50  0001 C CNN
F 3 "~" H 2150 7050 50  0001 C CNN
	1    2150 7050
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R8
U 1 1 5E005297
P 2400 7050
F 0 "R8" H 2459 7096 50  0000 L CNN
F 1 "10K" H 2459 7005 50  0000 L CNN
F 2 "digikey-footprints:0603" H 2400 7050 50  0001 C CNN
F 3 "~" H 2400 7050 50  0001 C CNN
	1    2400 7050
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R9
U 1 1 5E00AEDC
P 2650 7050
F 0 "R9" H 2709 7096 50  0000 L CNN
F 1 "10K" H 2709 7005 50  0000 L CNN
F 2 "digikey-footprints:0603" H 2650 7050 50  0001 C CNN
F 3 "~" H 2650 7050 50  0001 C CNN
	1    2650 7050
	1    0    0    -1  
$EndComp
Text GLabel 650  7350 3    50   Input ~ 0
PA2
Text GLabel 900  7350 3    50   Input ~ 0
PA3
Text GLabel 1150 7350 3    50   Input ~ 0
PB6
Text GLabel 1400 7350 3    50   Input ~ 0
PB7
Text GLabel 1650 7350 3    50   Input ~ 0
PB3
Text GLabel 1900 7350 3    50   Input ~ 0
PB4
Text GLabel 2150 7350 3    50   Input ~ 0
PA9
Text GLabel 2400 7350 3    50   Input ~ 0
PA10
Text GLabel 2650 7350 3    50   Input ~ 0
PA13
Wire Wire Line
	650  7350 650  7150
Wire Wire Line
	900  7350 900  7150
Wire Wire Line
	1150 7350 1150 7150
Wire Wire Line
	1400 7350 1400 7150
Wire Wire Line
	1650 7350 1650 7150
Wire Wire Line
	1900 7350 1900 7150
Wire Wire Line
	2150 7350 2150 7150
Wire Wire Line
	2400 7350 2400 7150
Wire Wire Line
	2650 7350 2650 7150
Text GLabel 1150 6600 0    50   Input ~ 0
VDD
Wire Wire Line
	1150 6950 1150 6850
Wire Wire Line
	650  6950 650  6850
Wire Wire Line
	650  6850 900  6850
Connection ~ 1150 6850
Wire Wire Line
	1150 6850 1150 6600
Wire Wire Line
	900  6950 900  6850
Connection ~ 900  6850
Wire Wire Line
	900  6850 1150 6850
Wire Wire Line
	1150 6850 1400 6850
Wire Wire Line
	2650 6850 2650 6950
Wire Wire Line
	2400 6950 2400 6850
Connection ~ 2400 6850
Wire Wire Line
	2400 6850 2650 6850
Wire Wire Line
	2150 6950 2150 6850
Connection ~ 2150 6850
Wire Wire Line
	2150 6850 2400 6850
Wire Wire Line
	1900 6950 1900 6850
Connection ~ 1900 6850
Wire Wire Line
	1900 6850 2150 6850
Wire Wire Line
	1650 6950 1650 6850
Connection ~ 1650 6850
Wire Wire Line
	1650 6850 1900 6850
Wire Wire Line
	1400 6950 1400 6850
Connection ~ 1400 6850
Wire Wire Line
	1400 6850 1650 6850
$Comp
L Device:R_Small R10
U 1 1 5E0B2A9C
P 1200 5950
F 0 "R10" V 1396 5950 50  0000 C CNN
F 1 "0Ω" V 1305 5950 50  0000 C CNN
F 2 "digikey-footprints:0603" H 1200 5950 50  0001 C CNN
F 3 "~" H 1200 5950 50  0001 C CNN
	1    1200 5950
	0    -1   -1   0   
$EndComp
$Comp
L Device:R_Small R11
U 1 1 5E0BAA6F
P 1350 6200
F 0 "R11" H 1409 6246 50  0000 L CNN
F 1 "10K" H 1409 6155 50  0000 L CNN
F 2 "digikey-footprints:0603" H 1350 6200 50  0001 C CNN
F 3 "~" H 1350 6200 50  0001 C CNN
	1    1350 6200
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R12
U 1 1 5E0C2B0F
P 2000 5950
F 0 "R12" V 1804 5950 50  0000 C CNN
F 1 "0Ω" V 1895 5950 50  0000 C CNN
F 2 "digikey-footprints:0603" H 2000 5950 50  0001 C CNN
F 3 "~" H 2000 5950 50  0001 C CNN
	1    2000 5950
	0    1    1    0   
$EndComp
$Comp
L Device:R_Small R13
U 1 1 5E0CADC6
P 2200 6200
F 0 "R13" H 2259 6246 50  0000 L CNN
F 1 "10M" H 2259 6155 50  0000 L CNN
F 2 "digikey-footprints:0603" H 2200 6200 50  0001 C CNN
F 3 "~" H 2200 6200 50  0001 C CNN
	1    2200 6200
	1    0    0    -1  
$EndComp
$Comp
L Device:C_Small C10
U 1 1 5E0D32D8
P 1550 5950
F 0 "C10" V 1321 5950 50  0000 C CNN
F 1 "100pF" V 1412 5950 50  0000 C CNN
F 2 "digikey-footprints:0603" H 1550 5950 50  0001 C CNN
F 3 "~" H 1550 5950 50  0001 C CNN
	1    1550 5950
	0    1    1    0   
$EndComp
$Comp
L Device:C_Small C11
U 1 1 5E0DB41E
P 2450 5950
F 0 "C11" V 2221 5950 50  0000 C CNN
F 1 "100pF" V 2312 5950 50  0000 C CNN
F 2 "digikey-footprints:0603" H 2450 5950 50  0001 C CNN
F 3 "~" H 2450 5950 50  0001 C CNN
	1    2450 5950
	0    1    1    0   
$EndComp
Wire Wire Line
	1300 5950 1350 5950
Wire Wire Line
	1350 5950 1350 6100
Wire Wire Line
	1450 5950 1350 5950
Connection ~ 1350 5950
Wire Wire Line
	1350 6300 1650 6300
Wire Wire Line
	1650 6300 1650 5950
Wire Wire Line
	2200 6300 1900 6300
Connection ~ 1650 6300
Wire Wire Line
	2100 5950 2150 5950
Wire Wire Line
	2200 5950 2200 6100
Wire Wire Line
	2200 5950 2350 5950
Connection ~ 2200 5950
Wire Wire Line
	2550 5950 2550 6300
Wire Wire Line
	2550 6300 2200 6300
Connection ~ 2200 6300
Text GLabel 1900 6450 3    50   Input ~ 0
GND
Wire Wire Line
	1900 6450 1900 6300
Connection ~ 1900 6300
Wire Wire Line
	1900 6300 1650 6300
Text GLabel 1000 5950 0    50   Input ~ 0
PA8-1
Text GLabel 1800 5600 0    50   Input ~ 0
PB14-1
Text GLabel 1250 5600 0    50   Input ~ 0
PA8
Text GLabel 2150 5600 0    50   Input ~ 0
PB14
Wire Wire Line
	2150 5600 2150 5950
Wire Wire Line
	2150 5950 2200 5950
Connection ~ 2150 5950
Wire Wire Line
	1900 5950 1900 5600
Wire Wire Line
	1900 5600 1800 5600
Wire Wire Line
	1350 5950 1350 5600
Wire Wire Line
	1350 5600 1250 5600
Wire Wire Line
	1100 5950 1000 5950
$Comp
L Device:R_Small R14
U 1 1 5E1AD592
P 950 4900
F 0 "R14" H 1009 4946 50  0000 L CNN
F 1 "12Ω" H 1009 4855 50  0000 L CNN
F 2 "digikey-footprints:0603" H 950 4900 50  0001 C CNN
F 3 "~" H 950 4900 50  0001 C CNN
	1    950  4900
	1    0    0    -1  
$EndComp
Text GLabel 950  5100 3    50   Input ~ 0
GND
$Comp
L Device:R_Small R15
U 1 1 5E1B7D6D
P 2100 5050
F 0 "R15" H 2159 5096 50  0000 L CNN
F 1 "10K" H 2159 5005 50  0000 L CNN
F 2 "digikey-footprints:0603" H 2100 5050 50  0001 C CNN
F 3 "~" H 2100 5050 50  0001 C CNN
	1    2100 5050
	1    0    0    -1  
$EndComp
Text GLabel 2100 5250 3    50   Input ~ 0
GND
Text GLabel 800  4400 0    50   Input ~ 0
PA1
Text GLabel 1950 4600 0    50   Input ~ 0
PA14
Wire Wire Line
	800  4400 950  4400
Wire Wire Line
	950  4400 950  4800
Wire Wire Line
	1950 4600 2100 4600
Wire Wire Line
	2100 4600 2100 4950
Wire Wire Line
	2100 5250 2100 5150
Wire Wire Line
	950  5100 950  5000
Text GLabel 9550 700  0    50   Input ~ 0
VBAT
Text GLabel 10650 700  2    50   Input ~ 0
VDD
Text GLabel 9550 1000 0    50   Input ~ 0
BATTERY
Text GLabel 9500 1200 0    50   Input ~ 0
GND
Text GLabel 9500 1450 0    50   Input ~ 0
BATTERY
Text GLabel 9500 1650 0    50   Input ~ 0
VBAT
Text GLabel 9500 1950 0    50   Input ~ 0
3V3
Text GLabel 9750 1950 2    50   Input ~ 0
VDD
Wire Wire Line
	9500 1950 9750 1950
Wire Wire Line
	9650 1650 9500 1650
Wire Wire Line
	9550 1000 10050 1000
$Comp
L Device:R_Small R16
U 1 1 5E2DE879
P 6050 900
F 0 "R16" V 5854 900 50  0000 C CNN
F 1 "10K" V 5945 900 50  0000 C CNN
F 2 "digikey-footprints:0603" H 6050 900 50  0001 C CNN
F 3 "~" H 6050 900 50  0001 C CNN
	1    6050 900 
	0    1    1    0   
$EndComp
$Comp
L Device:R_Small R17
U 1 1 5E2E9B73
P 7250 1350
F 0 "R17" V 7054 1350 50  0000 C CNN
F 1 "10K" V 7145 1350 50  0000 C CNN
F 2 "digikey-footprints:0603" H 7250 1350 50  0001 C CNN
F 3 "~" H 7250 1350 50  0001 C CNN
	1    7250 1350
	0    1    1    0   
$EndComp
Text GLabel 7500 1350 2    50   Input ~ 0
GND
Text GLabel 7150 950  2    50   Input ~ 0
VDD
Text GLabel 5600 900  0    50   Input ~ 0
BOOT0
Text GLabel 6150 1250 0    50   Input ~ 0
PB2
Wire Wire Line
	5600 900  5950 900 
$Comp
L Device:R_Small R18
U 1 1 5E36B2F8
P 8400 650
F 0 "R18" V 8204 650 50  0000 C CNN
F 1 "2K" V 8295 650 50  0000 C CNN
F 2 "digikey-footprints:0603" H 8400 650 50  0001 C CNN
F 3 "~" H 8400 650 50  0001 C CNN
	1    8400 650 
	0    1    1    0   
$EndComp
Text GLabel 8050 650  0    50   Input ~ 0
PA8-1
Wire Wire Line
	8050 650  8300 650 
$Comp
L Device:LED D2
U 1 1 5E38DF9C
P 8700 850
F 0 "D2" V 8739 732 50  0000 R CNN
F 1 "GREEN" V 8648 732 50  0000 R CNN
F 2 "digikey-footprints:0603" H 8700 850 50  0001 C CNN
F 3 "~" H 8700 850 50  0001 C CNN
	1    8700 850 
	0    -1   -1   0   
$EndComp
Wire Wire Line
	8700 650  8700 700 
Wire Wire Line
	8500 650  8700 650 
Text GLabel 8700 1200 3    50   Input ~ 0
GND
Wire Wire Line
	8700 1200 8700 1000
Text GLabel 9400 2250 0    50   Input ~ 0
VDD
Text GLabel 10300 2500 2    50   Input ~ 0
RST
Text GLabel 9850 2900 3    50   Input ~ 0
GND
$Comp
L Device:R_Small R19
U 1 1 5E3B4995
P 9650 2250
F 0 "R19" V 9454 2250 50  0000 C CNN
F 1 "10K" V 9545 2250 50  0000 C CNN
F 2 "digikey-footprints:0603" H 9650 2250 50  0001 C CNN
F 3 "~" H 9650 2250 50  0001 C CNN
	1    9650 2250
	0    1    1    0   
$EndComp
$Comp
L Device:C_Small C12
U 1 1 5E3C0D84
P 10050 2750
F 0 "C12" H 9958 2704 50  0000 R CNN
F 1 "0.1uF" H 9958 2795 50  0000 R CNN
F 2 "digikey-footprints:0603" H 10050 2750 50  0001 C CNN
F 3 "~" H 10050 2750 50  0001 C CNN
	1    10050 2750
	-1   0    0    1   
$EndComp
Wire Wire Line
	9400 2250 9550 2250
Wire Wire Line
	9750 2250 9800 2250
Wire Wire Line
	10050 2250 10050 2500
Wire Wire Line
	10050 2850 9850 2850
Wire Wire Line
	9850 2850 9850 2900
Wire Wire Line
	10300 2500 10050 2500
Connection ~ 10050 2500
Wire Wire Line
	10050 2500 10050 2650
$Comp
L Switch:SW_DIP_x01 SW1
U 1 1 5E412F92
P 9550 2650
F 0 "SW1" V 9504 2780 50  0000 L CNN
F 1 "SW" V 9595 2780 50  0001 L CNN
F 2 "digikey-footprints:Switch_Tactile_SMD_6x6mm" H 9550 2650 50  0001 C CNN
F 3 "~" H 9550 2650 50  0001 C CNN
	1    9550 2650
	0    1    1    0   
$EndComp
Wire Wire Line
	9800 2250 9800 2350
Wire Wire Line
	9800 2350 9550 2350
Connection ~ 9800 2250
Wire Wire Line
	9800 2250 10050 2250
Wire Wire Line
	9550 2950 9750 2950
Wire Wire Line
	9750 2950 9750 2850
Wire Wire Line
	9750 2850 9850 2850
Connection ~ 9850 2850
$Comp
L Connector_Generic:Conn_01x02 J5
U 1 1 5E4D2D51
P 10300 1050
F 0 "J5" H 10380 1042 50  0000 L CNN
F 1 "01x02" H 10380 951 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x02_P2.54mm_Vertical" H 10300 1050 50  0001 C CNN
F 3 "~" H 10300 1050 50  0001 C CNN
	1    10300 1050
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x02 J2
U 1 1 5E4D471C
P 9950 1500
F 0 "J2" H 10030 1492 50  0000 L CNN
F 1 "01x02" H 10030 1401 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x02_P2.54mm_Vertical" H 9950 1500 50  0001 C CNN
F 3 "~" H 9950 1500 50  0001 C CNN
	1    9950 1500
	1    0    0    -1  
$EndComp
Wire Wire Line
	10050 1000 10050 1050
Wire Wire Line
	10050 1050 10100 1050
Wire Wire Line
	10100 1200 10100 1150
Wire Wire Line
	9500 1200 10100 1200
Wire Wire Line
	9750 1450 9750 1500
Wire Wire Line
	9500 1450 9750 1450
Wire Wire Line
	9750 1600 9650 1600
Wire Wire Line
	9650 1600 9650 1650
Text GLabel 9250 3250 0    50   Input ~ 0
VDD
Text GLabel 9250 3350 0    50   Input ~ 0
GND
Text GLabel 9250 3450 0    50   Input ~ 0
PA10
Text GLabel 9250 3550 0    50   Input ~ 0
PA9
Text GLabel 9250 3650 0    50   Input ~ 0
PB4
Text GLabel 9250 3750 0    50   Input ~ 0
PB3
Text GLabel 9250 3850 0    50   Input ~ 0
PB7
Text GLabel 9250 3950 0    50   Input ~ 0
PB6
Text GLabel 9250 4050 0    50   Input ~ 0
PA3
Text GLabel 9250 4150 0    50   Input ~ 0
PA2
Text GLabel 9250 4250 0    50   Input ~ 0
PA1
Text GLabel 9250 4350 0    50   Input ~ 0
PA0
Text GLabel 10650 3250 2    50   Input ~ 0
RST
Text GLabel 10650 3350 2    50   Input ~ 0
D_P
Text GLabel 10650 3450 2    50   Input ~ 0
D_N
Text GLabel 10650 3550 2    50   Input ~ 0
PA14
Text GLabel 10650 3650 2    50   Input ~ 0
PB13
Text GLabel 10650 3750 2    50   Input ~ 0
PB12
Text GLabel 10650 3850 2    50   Input ~ 0
PB15
Text GLabel 10650 3950 2    50   Input ~ 0
PB14-1
Text GLabel 10650 4050 2    50   Input ~ 0
PA13
Text GLabel 10650 4150 2    50   Input ~ 0
PA8-1
Text GLabel 10650 4250 2    50   Input ~ 0
GND
Text GLabel 10650 4350 2    50   Input ~ 0
+5V
Wire Wire Line
	9250 3250 9500 3250
Wire Wire Line
	9500 3350 9250 3350
Wire Wire Line
	9250 3450 9500 3450
Wire Wire Line
	9500 3550 9250 3550
Wire Wire Line
	9250 3650 9500 3650
Wire Wire Line
	9500 3750 9250 3750
Wire Wire Line
	9250 3850 9500 3850
Wire Wire Line
	9500 3950 9250 3950
Wire Wire Line
	9250 4050 9500 4050
Wire Wire Line
	9500 4150 9250 4150
Wire Wire Line
	9250 4250 9500 4250
Wire Wire Line
	9500 4350 9250 4350
Wire Wire Line
	10500 3250 10650 3250
Wire Wire Line
	10500 3350 10650 3350
Wire Wire Line
	10650 3450 10500 3450
Wire Wire Line
	10500 3550 10650 3550
Wire Wire Line
	10650 3650 10500 3650
Wire Wire Line
	10500 3750 10650 3750
Wire Wire Line
	10650 3850 10500 3850
Wire Wire Line
	10650 3950 10500 3950
Wire Wire Line
	10500 4050 10650 4050
Wire Wire Line
	10650 4150 10500 4150
Wire Wire Line
	10500 4250 10650 4250
Wire Wire Line
	10650 4350 10500 4350
$Comp
L Device:C_Small C4
U 1 1 5DE9C5DE
P 3250 1100
F 0 "C4" V 3021 1100 50  0000 C CNN
F 1 "0.1uF" V 3388 1100 50  0000 C BNN
F 2 "digikey-footprints:0603" H 3250 1100 50  0001 C CNN
F 3 "~" H 3250 1100 50  0001 C CNN
	1    3250 1100
	0    1    1    0   
$EndComp
$Comp
L Device:C_Small C3
U 1 1 5DE9E0BD
P 3050 1000
F 0 "C3" V 2821 1000 50  0000 C CNN
F 1 "0.1uF" V 3030 1197 50  0000 C BNN
F 2 "digikey-footprints:0603" H 3050 1000 50  0001 C CNN
F 3 "~" H 3050 1000 50  0001 C CNN
	1    3050 1000
	0    1    1    0   
$EndComp
$Comp
L Device:C_Small C7
U 1 1 5DEE1A8F
P 1050 2350
F 0 "C7" V 1266 2350 50  0000 C CNN
F 1 "10pF" V 1199 2350 50  0000 C CNN
F 2 "digikey-footprints:0603" H 1050 2350 50  0001 C CNN
F 3 "~" H 1050 2350 50  0001 C CNN
	1    1050 2350
	0    1    1    0   
$EndComp
$Comp
L MCU_ST_STM32L0:STM32L072CZTx U1
U 1 1 5DE6246B
P 2650 2700
F 0 "U1" H 2600 1898 50  0000 C CNN
F 1 "STM32L072CZT6" H 2600 1807 50  0000 C CNN
F 2 "Package_QFP:LQFP-48_7x7mm_P0.5mm" H 2050 1300 50  0001 R CNN
F 3 "http://www.st.com/st-web-ui/static/active/en/resource/technical/document/datasheet/DM00141133.pdf" H 2650 2700 50  0001 C CNN
	1    2650 2700
	1    0    0    -1  
$EndComp
$Comp
L dk_Slide-Switches:JS202011SCQN S1
U 1 1 5DED3695
P 6750 1050
F 0 "S1" H 6750 1533 50  0000 C CNN
F 1 "JS202011SCQN" H 6750 1442 50  0000 C CNN
F 2 "digikey-footprints:Switch_Slide_JS202011SCQN" H 6950 1250 50  0001 L CNN
F 3 "https://www.ckswitches.com/media/1422/js.pdf" H 6950 1350 60  0001 L CNN
F 4 "401-2002-1-ND" H 6950 1450 60  0001 L CNN "Digi-Key_PN"
F 5 "JS202011SCQN" H 6950 1550 60  0001 L CNN "MPN"
F 6 "Switches" H 6950 1650 60  0001 L CNN "Category"
F 7 "Slide Switches" H 6950 1750 60  0001 L CNN "Family"
F 8 "https://www.ckswitches.com/media/1422/js.pdf" H 6950 1850 60  0001 L CNN "DK_Datasheet_Link"
F 9 "/product-detail/en/c-k/JS202011SCQN/401-2002-1-ND/1640098" H 6950 1950 60  0001 L CNN "DK_Detail_Page"
F 10 "SWITCH SLIDE DPDT 300MA 6V" H 6950 2050 60  0001 L CNN "Description"
F 11 "C&K" H 6950 2150 60  0001 L CNN "Manufacturer"
F 12 "Active" H 6950 2250 60  0001 L CNN "Status"
	1    6750 1050
	1    0    0    -1  
$EndComp
Text GLabel 7150 750  2    50   Input ~ 0
GND
Wire Wire Line
	7150 750  6950 750 
Wire Wire Line
	6150 900  6550 900 
Wire Wire Line
	6550 900  6550 850 
Wire Wire Line
	7150 950  6950 950 
Wire Wire Line
	6150 1250 6550 1250
Wire Wire Line
	7150 1350 6950 1350
Wire Wire Line
	7350 1350 7500 1350
Wire Wire Line
	7000 3750 7000 4150
Wire Wire Line
	6900 3750 6900 4150
Wire Wire Line
	6800 3750 6800 4150
Wire Wire Line
	7750 3250 7400 3250
Wire Wire Line
	1950 3000 1550 3000
Text GLabel 10300 1700 0    50   Input ~ 0
PA4
Wire Wire Line
	10300 1700 10500 1700
Wire Wire Line
	10650 700  10300 700 
$Comp
L dk_Coaxial-Connectors-RF:0734120114 J1
U 1 1 5E07B178
P 8400 2850
F 0 "J1" H 8478 3097 60  0000 C CNN
F 1 "0734120114" H 8478 2991 60  0000 C CNN
F 2 "digikey-footprints:Molex_734120114_UMC_RF_CONN_Vertical" H 8600 3050 60  0001 L CNN
F 3 "https://www.molex.com/pdm_docs/sd/734120110_sd.pdf" H 8600 3150 60  0001 L CNN
F 4 "WM3894CT-ND" H 8600 3250 60  0001 L CNN "Digi-Key_PN"
F 5 "0734120114" H 8600 3350 60  0001 L CNN "MPN"
F 6 "Connectors, Interconnects" H 8600 3450 60  0001 L CNN "Category"
F 7 "Coaxial Connectors (RF)" H 8600 3550 60  0001 L CNN "Family"
F 8 "https://www.molex.com/pdm_docs/sd/734120110_sd.pdf" H 8600 3650 60  0001 L CNN "DK_Datasheet_Link"
F 9 "/product-detail/en/molex/0734120114/WM3894CT-ND/2421931" H 8600 3750 60  0001 L CNN "DK_Detail_Page"
F 10 "CONN UMC RCPT STR 50 OHM SMD" H 8600 3850 60  0001 L CNN "Description"
F 11 "Molex" H 8600 3950 60  0001 L CNN "Manufacturer"
F 12 "Active" H 8600 4050 60  0001 L CNN "Status"
	1    8400 2850
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R25
U 1 1 5E07DC01
P 4000 5100
F 0 "R25" H 4059 5146 50  0000 L CNN
F 1 "10M" H 4059 5055 50  0000 L CNN
F 2 "digikey-footprints:0603" H 4000 5100 50  0001 C CNN
F 3 "~" H 4000 5100 50  0001 C CNN
	1    4000 5100
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R20
U 1 1 5E08ED51
P 3750 5900
F 0 "R20" H 3809 5946 50  0000 L CNN
F 1 "1K" H 3809 5855 50  0000 L CNN
F 2 "digikey-footprints:0603" H 3750 5900 50  0001 C CNN
F 3 "~" H 3750 5900 50  0001 C CNN
	1    3750 5900
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R23
U 1 1 5E09FBFF
P 4900 6100
F 0 "R23" H 4959 6146 50  0000 L CNN
F 1 "1K" H 4959 6055 50  0000 L CNN
F 2 "digikey-footprints:0603" H 4900 6100 50  0001 C CNN
F 3 "~" H 4900 6100 50  0001 C CNN
	1    4900 6100
	0    1    1    0   
$EndComp
$Comp
L Device:R_Small R24
U 1 1 5E0B0DC4
P 6000 6400
F 0 "R24" H 6059 6446 50  0000 L CNN
F 1 "100K" H 6059 6355 50  0000 L CNN
F 2 "digikey-footprints:0603" H 6000 6400 50  0001 C CNN
F 3 "~" H 6000 6400 50  0001 C CNN
	1    6000 6400
	0    1    1    0   
$EndComp
$Comp
L Device:R_Small R22
U 1 1 5E0C204D
P 5500 5600
F 0 "R22" H 5559 5646 50  0000 L CNN
F 1 "1M" H 5559 5555 50  0000 L CNN
F 2 "digikey-footprints:0603" H 5500 5600 50  0001 C CNN
F 3 "~" H 5500 5600 50  0001 C CNN
	1    5500 5600
	1    0    0    -1  
$EndComp
$Comp
L Device:R_Small R21
U 1 1 5E0D35AD
P 5500 5200
F 0 "R21" H 5559 5246 50  0000 L CNN
F 1 "3M" H 5559 5155 50  0000 L CNN
F 2 "digikey-footprints:0603" H 5500 5200 50  0001 C CNN
F 3 "~" H 5500 5200 50  0001 C CNN
	1    5500 5200
	1    0    0    -1  
$EndComp
$Comp
L Device:C_Small C14
U 1 1 5E0E4C23
P 5250 5200
F 0 "C14" V 5021 5200 50  0000 C CNN
F 1 "1uF" V 5112 5200 50  0000 C CNN
F 2 "digikey-footprints:0603" H 5250 5200 50  0001 C CNN
F 3 "~" H 5250 5200 50  0001 C CNN
	1    5250 5200
	-1   0    0    1   
$EndComp
$Comp
L Device:C_Small C17
U 1 1 5E0F5BBB
P 5900 5200
F 0 "C17" V 5671 5200 50  0000 C CNN
F 1 "1nF" V 5762 5200 50  0000 C CNN
F 2 "digikey-footprints:0603" H 5900 5200 50  0001 C CNN
F 3 "~" H 5900 5200 50  0001 C CNN
	1    5900 5200
	-1   0    0    1   
$EndComp
$Comp
L Device:C_Small C16
U 1 1 5E10773D
P 6500 5200
F 0 "C16" V 6271 5200 50  0000 C CNN
F 1 "10uF" V 6362 5200 50  0000 C CNN
F 2 "digikey-footprints:0603" H 6500 5200 50  0001 C CNN
F 3 "~" H 6500 5200 50  0001 C CNN
	1    6500 5200
	-1   0    0    1   
$EndComp
$Comp
L Device:CP1_Small C13
U 1 1 5E13A285
P 4450 5100
F 0 "C13" H 4541 5146 50  0000 L CNN
F 1 "100uF" H 4541 5055 50  0000 L CNN
F 2 "digikey-footprints:0805" H 4450 5100 50  0001 C CNN
F 3 "~" H 4450 5100 50  0001 C CNN
	1    4450 5100
	1    0    0    -1  
$EndComp
$Comp
L Device:CP1_Small C15
U 1 1 5E13C0AE
P 6200 5200
F 0 "C15" H 6291 5246 50  0000 L CNN
F 1 "100uF" H 6291 5155 50  0000 L CNN
F 2 "digikey-footprints:0805" H 6200 5200 50  0001 C CNN
F 3 "~" H 6200 5200 50  0001 C CNN
	1    6200 5200
	1    0    0    -1  
$EndComp
$Comp
L dk_Diodes-Rectifiers-Single:1N5819 D3
U 1 1 5E17F38C
P 5550 4750
F 0 "D3" H 5550 4987 60  0000 C CNN
F 1 "1N5819" H 5550 4881 60  0000 C CNN
F 2 "digikey-footprints:DO-41" H 5750 4950 60  0001 L CNN
F 3 "https://www.onsemi.com/pub/Collateral/1N5817-D.PDF" H 5750 5050 60  0001 L CNN
F 4 "1N5819FSCT-ND" H 5750 5150 60  0001 L CNN "Digi-Key_PN"
F 5 "1N5819" H 5750 5250 60  0001 L CNN "MPN"
F 6 "Discrete Semiconductor Products" H 5750 5350 60  0001 L CNN "Category"
F 7 "Diodes - Rectifiers - Single" H 5750 5450 60  0001 L CNN "Family"
F 8 "https://www.onsemi.com/pub/Collateral/1N5817-D.PDF" H 5750 5550 60  0001 L CNN "DK_Datasheet_Link"
F 9 "/product-detail/en/on-semiconductor/1N5819/1N5819FSCT-ND/965482" H 5750 5650 60  0001 L CNN "DK_Detail_Page"
F 10 "DIODE SCHOTTKY 40V 1A DO41" H 5750 5750 60  0001 L CNN "Description"
F 11 "ON Semiconductor" H 5750 5850 60  0001 L CNN "Manufacturer"
F 12 "Active" H 5750 5950 60  0001 L CNN "Status"
	1    5550 4750
	1    0    0    -1  
$EndComp
Text GLabel 4450 4650 1    50   Input ~ 0
VDD
Text GLabel 4000 5800 3    50   Input ~ 0
GND
Text GLabel 5500 5850 3    50   Input ~ 0
GND
Text GLabel 4000 6250 3    50   Input ~ 0
PB5
$Comp
L dk_Transistors-FETs-MOSFETs-Single:BSS138-7-F Q1
U 1 1 5E189BE8
P 4000 5500
F 0 "Q1" H 4108 5553 60  0000 L CNN
F 1 "BSS138-7-F" H 4108 5447 60  0000 L CNN
F 2 "digikey-footprints:SOT-23-3" H 4200 5700 60  0001 L CNN
F 3 "https://www.diodes.com/assets/Datasheets/ds30144.pdf" H 4200 5800 60  0001 L CNN
F 4 "BSS138-FDICT-ND" H 4200 5900 60  0001 L CNN "Digi-Key_PN"
F 5 "BSS138-7-F" H 4200 6000 60  0001 L CNN "MPN"
F 6 "Discrete Semiconductor Products" H 4200 6100 60  0001 L CNN "Category"
F 7 "Transistors - FETs, MOSFETs - Single" H 4200 6200 60  0001 L CNN "Family"
F 8 "https://www.diodes.com/assets/Datasheets/ds30144.pdf" H 4200 6300 60  0001 L CNN "DK_Datasheet_Link"
F 9 "/product-detail/en/diodes-incorporated/BSS138-7-F/BSS138-FDICT-ND/717843" H 4200 6400 60  0001 L CNN "DK_Detail_Page"
F 10 "MOSFET N-CH 50V 200MA SOT23-3" H 4200 6500 60  0001 L CNN "Description"
F 11 "Diodes Incorporated" H 4200 6600 60  0001 L CNN "Manufacturer"
F 12 "Active" H 4200 6700 60  0001 L CNN "Status"
	1    4000 5500
	1    0    0    -1  
$EndComp
$Comp
L Transistor_FET:AO3401A Q2
U 1 1 5E18C86C
P 6050 6100
F 0 "Q2" H 6255 6146 50  0000 L CNN
F 1 "ZVP1320FTA " H 6255 6055 50  0000 L CNN
F 2 "Package_TO_SOT_SMD:SOT-23" H 6250 6025 50  0001 L CIN
F 3 "http://www.aosmd.com/pdfs/datasheet/AO3401A.pdf" H 6050 6100 50  0001 L CNN
	1    6050 6100
	1    0    0    -1  
$EndComp
Text GLabel 6500 5900 2    50   Input ~ 0
+5V
Wire Wire Line
	4450 4650 4450 4750
Wire Wire Line
	4700 4750 4450 4750
Connection ~ 4450 4750
Wire Wire Line
	4450 4750 4450 5000
Wire Wire Line
	4000 5000 4000 4750
Wire Wire Line
	4000 4750 4450 4750
Wire Wire Line
	5100 4750 5350 4750
Wire Wire Line
	4000 5200 4000 5250
Wire Wire Line
	3700 5600 3700 5800
Wire Wire Line
	3700 5800 3750 5800
Wire Wire Line
	4000 5700 4000 5750
Wire Wire Line
	3750 6000 3750 6100
Wire Wire Line
	3750 6100 4000 6100
Wire Wire Line
	4000 6250 4000 6100
Connection ~ 4000 6100
Wire Wire Line
	4000 6100 4800 6100
Wire Wire Line
	5000 6100 5200 6100
Wire Wire Line
	5900 6400 5200 6400
Wire Wire Line
	5200 6400 5200 6100
Connection ~ 5200 6100
Wire Wire Line
	5200 6100 5850 6100
Wire Wire Line
	6100 6400 6150 6400
Wire Wire Line
	6150 6400 6150 6300
Wire Wire Line
	6150 5900 6500 5900
Wire Wire Line
	5250 5100 5500 5100
Wire Wire Line
	5500 5100 5900 5100
Connection ~ 5500 5100
Wire Wire Line
	5900 5100 6200 5100
Connection ~ 5900 5100
Wire Wire Line
	6200 5100 6500 5100
Connection ~ 6200 5100
Wire Wire Line
	6500 5100 6900 5100
Wire Wire Line
	6900 5100 6900 6400
Wire Wire Line
	6900 6400 6150 6400
Connection ~ 6500 5100
Connection ~ 6150 6400
Wire Wire Line
	5500 5850 5500 5750
Wire Wire Line
	5500 5500 5500 5450
Wire Wire Line
	5900 5300 5900 5450
Wire Wire Line
	5900 5450 5500 5450
Connection ~ 5500 5450
Wire Wire Line
	5500 5450 5500 5300
Wire Wire Line
	5250 5300 5250 5750
Wire Wire Line
	5250 5750 5500 5750
Connection ~ 5500 5750
Wire Wire Line
	5500 5750 5500 5700
Wire Wire Line
	5500 5750 6200 5750
Wire Wire Line
	6200 5750 6200 5300
Wire Wire Line
	6500 5300 6500 5750
Wire Wire Line
	6500 5750 6200 5750
Connection ~ 6200 5750
Wire Wire Line
	5750 4750 6200 4750
Wire Wire Line
	6200 4750 6200 5100
$Comp
L Uncle:RT9266 U4
U 1 1 5E3F08E4
P 4900 6100
F 0 "U4" H 4900 6765 50  0000 C CNN
F 1 "RT9266" H 4900 6674 50  0000 C CNN
F 2 "digikey-footprints:SOT-23-6" H 4900 6100 50  0001 C CNN
F 3 "" H 4900 6100 50  0001 C CNN
	1    4900 6100
	1    0    0    -1  
$EndComp
Wire Wire Line
	4600 5700 4250 5700
Wire Wire Line
	4250 5700 4250 5250
Wire Wire Line
	4250 5250 4000 5250
Connection ~ 4000 5250
Wire Wire Line
	4000 5250 4000 5300
Wire Wire Line
	4600 5900 4150 5900
Wire Wire Line
	4150 5900 4150 5750
Wire Wire Line
	4150 5750 4000 5750
Connection ~ 4000 5750
Wire Wire Line
	4000 5750 4000 5800
Wire Wire Line
	5200 5900 5350 5900
Wire Wire Line
	5350 5900 5350 4750
Connection ~ 5350 4750
Wire Wire Line
	5200 5800 5300 5800
Wire Wire Line
	5300 5800 5300 5500
Wire Wire Line
	5300 5500 5150 5500
Wire Wire Line
	5150 5500 5150 5100
Wire Wire Line
	5150 5100 5250 5100
Connection ~ 5250 5100
Wire Wire Line
	5200 5700 5400 5700
Wire Wire Line
	5400 5700 5400 5450
Wire Wire Line
	5400 5450 5500 5450
$Comp
L dk_Fixed-Inductors:82473C L1
U 1 1 5E1877DB
P 4900 4750
F 0 "L1" H 4900 4997 60  0000 C CNN
F 1 "82473C" H 4900 4891 60  0000 C CNN
F 2 "digikey-footprints:1210" H 5100 4950 60  0001 L CNN
F 3 "https://www.murata-ps.com/data/magnetics/kmp_8200c.pdf" H 5100 5050 60  0001 L CNN
F 4 "811-2477-1-ND" H 5100 5150 60  0001 L CNN "Digi-Key_PN"
F 5 "82473C" H 5100 5250 60  0001 L CNN "MPN"
F 6 "Inductors, Coils, Chokes" H 5100 5350 60  0001 L CNN "Category"
F 7 "Fixed Inductors" H 5100 5450 60  0001 L CNN "Family"
F 8 "https://www.murata-ps.com/data/magnetics/kmp_8200c.pdf" H 5100 5550 60  0001 L CNN "DK_Datasheet_Link"
F 9 "/product-detail/en/murata-power-solutions-inc/82473C/811-2477-1-ND/3178548" H 5100 5650 60  0001 L CNN "DK_Detail_Page"
F 10 "FIXED IND 47UH 250MA 1.69 OHM" H 5100 5750 60  0001 L CNN "Description"
F 11 "Murata Power Solutions Inc." H 5100 5850 60  0001 L CNN "Manufacturer"
F 12 "Active" H 5100 5950 60  0001 L CNN "Status"
	1    4900 4750
	1    0    0    -1  
$EndComp
Text GLabel 4450 5350 2    50   Input ~ 0
GND
Wire Wire Line
	4450 5350 4450 5200
$Comp
L Diode:1N4001 D1
U 1 1 5E4D2EEA
P 10150 700
F 0 "D1" H 10150 916 50  0000 C CNN
F 1 "1N4001" H 10150 825 50  0000 C CNN
F 2 "Diode_THT:D_DO-41_SOD81_P10.16mm_Horizontal" H 10150 525 50  0001 C CNN
F 3 "http://www.vishay.com/docs/88503/1n4001.pdf" H 10150 700 50  0001 C CNN
	1    10150 700 
	-1   0    0    -1  
$EndComp
Wire Wire Line
	9550 700  10000 700 
$Comp
L Connector_Generic:Conn_01x01 J6
U 1 1 5E00E094
P 10700 1700
F 0 "J6" H 10780 1742 50  0000 L CNN
F 1 "01x01" H 10780 1651 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10700 1700 50  0001 C CNN
F 3 "~" H 10700 1700 50  0001 C CNN
	1    10700 1700
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J28
U 1 1 5E691F03
P 9700 3250
F 0 "J28" H 9780 3292 50  0000 L CNN
F 1 "01x01" H 9780 3201 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 3250 50  0001 C CNN
F 3 "~" H 9700 3250 50  0001 C CNN
	1    9700 3250
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J7
U 1 1 5E6A96B9
P 9700 3350
F 0 "J7" H 9780 3392 50  0000 L CNN
F 1 "01x01" H 9780 3301 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 3350 50  0001 C CNN
F 3 "~" H 9700 3350 50  0001 C CNN
	1    9700 3350
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J8
U 1 1 5E6C0D50
P 9700 3450
F 0 "J8" H 9780 3492 50  0000 L CNN
F 1 "01x01" H 9780 3401 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 3450 50  0001 C CNN
F 3 "~" H 9700 3450 50  0001 C CNN
	1    9700 3450
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J9
U 1 1 5E6D8449
P 9700 3550
F 0 "J9" H 9780 3592 50  0000 L CNN
F 1 "01x01" H 9780 3501 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 3550 50  0001 C CNN
F 3 "~" H 9700 3550 50  0001 C CNN
	1    9700 3550
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J3
U 1 1 5E707692
P 9700 3650
F 0 "J3" H 9780 3692 50  0000 L CNN
F 1 "01x01" H 9780 3601 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 3650 50  0001 C CNN
F 3 "~" H 9700 3650 50  0001 C CNN
	1    9700 3650
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J10
U 1 1 5E71EC5D
P 9700 3750
F 0 "J10" H 9780 3792 50  0000 L CNN
F 1 "01x01" H 9780 3701 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 3750 50  0001 C CNN
F 3 "~" H 9700 3750 50  0001 C CNN
	1    9700 3750
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J11
U 1 1 5E7362C2
P 9700 3850
F 0 "J11" H 9780 3892 50  0000 L CNN
F 1 "01x01" H 9780 3801 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 3850 50  0001 C CNN
F 3 "~" H 9700 3850 50  0001 C CNN
	1    9700 3850
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J12
U 1 1 5E74D996
P 9700 3950
F 0 "J12" H 9780 3992 50  0000 L CNN
F 1 "01x01" H 9780 3901 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 3950 50  0001 C CNN
F 3 "~" H 9700 3950 50  0001 C CNN
	1    9700 3950
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J13
U 1 1 5E764FB3
P 9700 4050
F 0 "J13" H 9780 4092 50  0000 L CNN
F 1 "01x01" H 9780 4001 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 4050 50  0001 C CNN
F 3 "~" H 9700 4050 50  0001 C CNN
	1    9700 4050
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J14
U 1 1 5E77C696
P 9700 4150
F 0 "J14" H 9780 4192 50  0000 L CNN
F 1 "01x01" H 9780 4101 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 4150 50  0001 C CNN
F 3 "~" H 9700 4150 50  0001 C CNN
	1    9700 4150
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J15
U 1 1 5E793EE2
P 9700 4250
F 0 "J15" H 9780 4292 50  0000 L CNN
F 1 "01x01" H 9780 4201 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 4250 50  0001 C CNN
F 3 "~" H 9700 4250 50  0001 C CNN
	1    9700 4250
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J16
U 1 1 5E7AB5E0
P 9700 4350
F 0 "J16" H 9780 4392 50  0000 L CNN
F 1 "01x01" H 9780 4301 50  0000 L CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 9700 4350 50  0001 C CNN
F 3 "~" H 9700 4350 50  0001 C CNN
	1    9700 4350
	1    0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J27
U 1 1 5E7C344D
P 10300 3250
F 0 "J27" H 10218 3467 50  0000 C CNN
F 1 "01x01" H 10218 3376 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 3250 50  0001 C CNN
F 3 "~" H 10300 3250 50  0001 C CNN
	1    10300 3250
	-1   0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J26
U 1 1 5E80A7FF
P 10300 3350
F 0 "J26" H 10218 3567 50  0000 C CNN
F 1 "01x01" H 10218 3476 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 3350 50  0001 C CNN
F 3 "~" H 10300 3350 50  0001 C CNN
	1    10300 3350
	-1   0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J25
U 1 1 5E822134
P 10300 3450
F 0 "J25" H 10218 3667 50  0000 C CNN
F 1 "01x01" H 10218 3576 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 3450 50  0001 C CNN
F 3 "~" H 10300 3450 50  0001 C CNN
	1    10300 3450
	-1   0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J4
U 1 1 5E839930
P 10300 3550
F 0 "J4" H 10218 3767 50  0000 C CNN
F 1 "01x01" H 10218 3676 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 3550 50  0001 C CNN
F 3 "~" H 10300 3550 50  0001 C CNN
	1    10300 3550
	-1   0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J24
U 1 1 5E8511D9
P 10300 3650
F 0 "J24" H 10218 3867 50  0000 C CNN
F 1 "01x01" H 10218 3776 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 3650 50  0001 C CNN
F 3 "~" H 10300 3650 50  0001 C CNN
	1    10300 3650
	-1   0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J23
U 1 1 5E868997
P 10300 3750
F 0 "J23" H 10218 3967 50  0000 C CNN
F 1 "01x01" H 10218 3876 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 3750 50  0001 C CNN
F 3 "~" H 10300 3750 50  0001 C CNN
	1    10300 3750
	-1   0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J22
U 1 1 5E88010C
P 10300 3850
F 0 "J22" H 10218 4067 50  0000 C CNN
F 1 "01x01" H 10218 3976 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 3850 50  0001 C CNN
F 3 "~" H 10300 3850 50  0001 C CNN
	1    10300 3850
	-1   0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J21
U 1 1 5E89784E
P 10300 3950
F 0 "J21" H 10218 4167 50  0000 C CNN
F 1 "01x01" H 10218 4076 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 3950 50  0001 C CNN
F 3 "~" H 10300 3950 50  0001 C CNN
	1    10300 3950
	-1   0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J20
U 1 1 5E8AEF70
P 10300 4050
F 0 "J20" H 10218 4267 50  0000 C CNN
F 1 "01x01" H 10218 4176 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 4050 50  0001 C CNN
F 3 "~" H 10300 4050 50  0001 C CNN
	1    10300 4050
	-1   0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J19
U 1 1 5E8C6624
P 10300 4150
F 0 "J19" H 10218 4367 50  0000 C CNN
F 1 "01x01" H 10218 4276 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 4150 50  0001 C CNN
F 3 "~" H 10300 4150 50  0001 C CNN
	1    10300 4150
	-1   0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J18
U 1 1 5E8DDCB3
P 10300 4250
F 0 "J18" H 10218 4467 50  0000 C CNN
F 1 "01x01" H 10218 4376 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 4250 50  0001 C CNN
F 3 "~" H 10300 4250 50  0001 C CNN
	1    10300 4250
	-1   0    0    -1  
$EndComp
$Comp
L Connector_Generic:Conn_01x01 J17
U 1 1 5E90D0AD
P 10300 4350
F 0 "J17" H 10218 4567 50  0000 C CNN
F 1 "01x01" H 10218 4476 50  0000 C CNN
F 2 "Connector_PinHeader_2.54mm:PinHeader_1x01_P2.54mm_Vertical" H 10300 4350 50  0001 C CNN
F 3 "~" H 10300 4350 50  0001 C CNN
	1    10300 4350
	-1   0    0    -1  
$EndComp
$EndSCHEMATC
