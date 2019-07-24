#!/usr/bin/env python
import requests
import time
import sys
import os

url = "http://192.168.1.133/hd/simpan.php"

def main():
    while True:
        scan = raw_input()
        if scan:
            rfid = {'id': scan}
	    r = requests.post(url, params=rfid)
	    print(r.text)			 
        else:
            print "Access Denied"
 
main()  
