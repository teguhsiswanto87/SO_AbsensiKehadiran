#!/usr/bin/env python

import time
import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522

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
    cursor.execute("SELECT id FROM users WHERE id_rfid="+str(id))
    cursor.fetchone()

    if cursor.rowcount >= 1:
      overwrite = input("Overwite (Y/N)? ")
      if overwrite[0] == 'Y' or overwrite[0] == 'y':
        sql_insert = "UPDATE anggota SET username = %s WHERE id_rfid=%s"
      else:
        continue;
    else:
      sql_insert = "INSERT INTO anggota (username, id_rfid) VALUES (%s, %s)"
    new_name = input("Name: ")

    cursor.execute(sql_insert, (new_name, id))

    db.commit()

    time.sleep(2)
finally:
  GPIO.cleanup()