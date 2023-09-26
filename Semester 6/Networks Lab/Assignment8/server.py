import socket
import threading
import csv

dict = {}

with open('diseases.csv',mode = 'r') as inp :
        reader = csv.reader(inp)
        dict = {row[0] : row[1] for row in reader}

host = ''
port = 8986
server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
server.bind((host,port))
server.listen()


def handle(client) :
        while True :
                try :
                        client.send("+---------------------------------+\nEnter the name of disease : ".encode('ascii'))
                        message = client.recv(1024).decode('ascii')
                        print('\n+---------------------------------+\nMessage recieved : {}'.format(message))
                        message = message.lower()
                        if message in dict.keys() :
                                print("To send : Drug found : {}\n+---------------------------------+\n".format(dict[message]))
                                client.send("Drug found : {}\n+---------------------------------+\n\n".format(dict[message]).encode('ascii'))
                        else :
                                print("Drug not found\n+---------------------------------+\n")
                                client.send("\nDrug for this disease not found. We will update the system soon\n+---------------------------------+\n\n".encode('ascii'))

                except :
                        client.close()



# listening/ recieving function
def recieve():
        while True :
                # accepting connection
                client, address = server.accept()
                print('\n+---------------------------------+\nConnected with {}\n+---------------------------------+'.format(str(address)))
                thread = threading.Thread(target = handle,args = (client,))
                thread.start()


print('+---------------------------------+\nDiseases and Medicine known: ')
for (key,val) in dict.items() :
        print("{}   :   {}".format(key,val))

print('+---------------------------------+')
recieve()

