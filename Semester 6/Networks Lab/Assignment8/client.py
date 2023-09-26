import threading
import socket


client = socket.socket(socket.AF_INET,socket.SOCK_STREAM)
client.connect(('127.0.0.1',8986))


def recieve():
        while True :
                try :
                        message = client.recv(1024).decode('ascii')
                        print(message)
                except :
                        # Close Connection When Error
                        print("/nAn error occured!/n")
                        client.close()
                        break

def write() :
        while True :
                message = input()
                client.send(message.encode('ascii'))


recieve_thread = threading.Thread(target = recieve)
recieve_thread.start()

writer_thread = threading.Thread(target = write)
writer_thread.start()
