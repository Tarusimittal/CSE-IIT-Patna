import matplotlib.pyplot as plt
import queue as Q
import math
import random

# Simulating for fixed time
# EVENTS0 = generation of packet
# EVENTS1 = reaching Queue time
# EVENTS2 = leaving queue time
# EVENTS3 = reaching sink time

# class for source
class SOURCEINFO:
    def __init__(self, sid, bandSoSwi):
        self.sourceId = sid         # Every Source has a unique source id
        self.bandSoSwi = bandSoSwi  # It is the bandwidth of source to switch

# class for switch
class SWITCHINFO:
    def __init__(self, bwidth):
        self.bandSwSin = bwidth     # It is the bandwidth of switch to sink
        self.qSize = 0              # Initally in the class we take the size as 0


# class for packet
class PACKETINFO:
    def __init__(self, pid=0, gtime=0.0, sourceid=0):
        self.packetId = pid         # We define every packet with a unique packet id
        self.queueIn = -1           # The time the packet gets in the queue
        self.queueOut = -1          # The time the packet gets out of the queue
        self.sourceId = sourceid    # The sourceid of the source from where the packet was generated
        self.generationTime = gtime # The time it was generated
        self.sinkReachTime = -1     # the time it reaxhes the sink



# class for various EVENTS
class EVENTS:
    def __lt__(self, other):
        return self.currentTime < other.currentTime

    def __init__(self, eid, pid, t):
        self.eId = eid
        self.pId = pid
        self.currentTime = t

#Randomly allots a next time based on its rate
def nextTime(rateVariable):
        return -math.log(1.0 - random.uniform(0,1)) / rateVariable

# the function calculate dthe average queuing Size

def avgQueueSizeFunction(nSource, bandSoSwi, bandSwSin, pktLength, simulationTime,rate):
    packet = []                   # It will contain the information about all the packets
    switchInt = SWITCHINFO(bandSwSin) # declares a variable of the class SWITCHINFO with given bandwidth

    # We will generate first packet from every source at an fixed interval
    totaltime = 0.0

    # now we declare a priority queue
    # It adjusts the objects acording to the current time of the events
    pq = Q.PriorityQueue()

    # We will iterate for all the sources
    for i in range(nSource):
        packet.append(PACKETINFO(i, totaltime, i))  # We record all the information about our pavket in our packet array
        pq.put(EVENTS(0, i, totaltime))
        totaltime += 0.000001

    pktTot = nSource
    lastLeftTime = 0.0
    currentTime = 0
    simulationTime = 5000
    packet_sink = 0
    total_count = 0
    average_size = 0

    #We will iterate the loop until the pkt reaching sink is not gretaer than the simulation time
    while (packet_sink < simulationTime):
        average_size += switchInt.qSize
        topPacket = pq.get()
        pid = topPacket.pId
        currentTime = topPacket.currentTime
        total_count += 1

        # EVENTS 0 -> (EVENTS0,EVENTS1)
        # first we see for our event 0->1 ie genration of packet and reaching the queue
        if topPacket.eId == 0:
            nextVarTime = nextTime(rate)
            pq.put(EVENTS(0, pktTot, currentTime + nextVarTime))
            packet.append(PACKETINFO(pktTot, currentTime + nextVarTime, packet[pid].sourceId))
            pktTot += 1
            flagSoSwi = pktLength / bandSoSwi
            pq.put(EVENTS(1, pid, currentTime + flagSoSwi))
            packet[pid].queueIn = currentTime + flagSoSwi

        # EVENTS 1 -> EVENTS2
        # now for event 1->2 ie entering to leaving the queue
        elif topPacket.eId == 1:
            reachTime = switchInt.qSize*pktLength
            reachTime = reachTime/bandSwSin
            addTime=0
            flag1=(pktLength / bandSwSin)
            if packet[pid].queueIn - lastLeftTime < flag1:
                addTime = max(0, flag1 - (packet[pid].queueIn - lastLeftTime))
            if lastLeftTime == 0:
                addTime = 0
            pq.put(EVENTS(2, pid, currentTime + reachTime + addTime))
            packet[pid].queueOut = currentTime + reachTime + addTime
            switchInt.qSize += 1

        # EVENTS2 -> EVENTS3
        # thsi is for event2->3 ie leaving the queue and reaching teh sink
        elif topPacket.eId == 2:
            switchInt.qSize = switchInt.qSize - 1
            lastLeftTime = currentTime
            flag2 = pktLength / bandSwSin
            sinkTime = currentTime + flag2
            packet[pid].sinkReachTime = sinkTime
            pq.put(EVENTS(3, pid, sinkTime))

        # thsis for the last stage where the packet reaches the sink
        # here we now update the value of packet reaching the sink
        else:
        	packet_sink += 1

    return average_size/total_count


def main():

    print ("Enter 0 to use default value or 1 to use own")
    resp = int(input())
    if resp == 0:
        # nsource = number of source
        nSource = 4

        # bandSoSwi = bandwidth between source and switch in bit
        bandSoSwi = 2e6

        # bandSwSin = bandwidth between switch and sink in bit
        bandSwSin = 4.6e6

        # pktLength = size of each packet in bit
        pktLength = 1e4

        #packetGenerate = packet genrate
        packetGenerate = 1

        #simulation time
        simulationTime = 5000
    else :

        nSource = int(input("Enter The Number of Sources :"))
        bandSoSwi = float(input("Enter the bandwdth between the Source and switch(bandSoSwi) in bit:"))
        bandSwSin = float(input("Enter the bandwidth between the switch and sink(bandSwSin) in bit:"))
        pktLength = int(input("Enter the packet length in bit(pktlength) :"))
        simulationTime =int(input("Enter the Simulation time:"))


    # creating source object
    source = []
    for i in range(nSource):
        source.append(SOURCEINFO(i, bandSoSwi))

    lamda = 4
    totalIterations = 20
    while (lamda < 1000):
        x.append(lamda)
        queue_size = 0
        iteration = 0
        while(iteration < totalIterations):
            queue_size+=avgQueueSizeFunction(nSource, bandSoSwi, bandSwSin, pktLength, simulationTime, lamda/nSource)
            iteration+=1
        print(lamda,queue_size/iteration)
        y.append(queue_size/totalIterations)
        lamda+=15

    #temp="nSource="+str(nSource)+",bandSoSwi(bit)="+str(bandSoSwi)+"\n pktlength="+str(pktLength)+" bit\n bandSwSin(bit) ="+ str(bandSwSin)+"\nlambda = 4-1000\n"

    # plotting curve
    plt.plot(x, y)
    plt.xlabel("Lamda")
    plt.ylabel("Average Queue Size")
    #plt.text(4,4,temp)
    plt.title("Average Queue Size vs Lamda")
    plt.show()


if __name__ == "__main__":
    main()
