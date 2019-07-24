#!/usr/bin/env python
import time
import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522
import mysql.connector

db = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="siswanto123321",
  database="so_absensi"
)

cursor = db.cursor()
reader = SimpleMFRC522()


try:
  while True:
    id, text = reader.read()

    cursor.execute("Select id_rfid, username FROM anggota WHERE id_rfid="+str(id))
    result = cursor.fetchone()


    if cursor.rowcount >= 1:
      cursor.execute("INSERT INTO absensi (username) VALUES (%s)", (result[0],) )
      db.commit()
    time.sleep(2)
finally:
  GPIO.cleanup()