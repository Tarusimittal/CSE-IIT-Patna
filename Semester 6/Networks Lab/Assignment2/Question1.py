
import matplotlib.pyplot as plt
import queue as Q
import math
import random

    # Simulating for fixed time
    # Event0 = generation of packet
    # Event1 = reaching Queue time
    # Event2 = leaving queue time
    # Event3 = reaching sink time


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
        self.sinkReachTime = -1     # The time it reaches teh sink
        self.sourceId = sourceid    # The sourceid of the source from where the packet was generated
        self.generationTime = gtime # The time it was generated



# class for various EVENTS
class EVENTS:
    def __lt__(self, other):
        return self.currentTime < other.currentTime

    def __init__(self, eid, pid, t):
        self.eId = eid
        self.pId = pid
        self.currentTime = t

def nextTime(rateVariable):
        return -math.log(1.0 - random.uniform(0,1)) / rateVariable


# function to calculate avg delay
# We are calculating the time taken by each packet to reach teh sink
# This time is basically the delay because of the switch wasnot there then the time taken
# would have been 0. So all the time that a packet is taking now is the delay
# And for the average we will sumation of all the delays divided by the total no of packets

def avgDelayFunction(nSource, bandSoSwi, bandSwSin, pktLength, simulationTime, rate):
    packet = []                   #It will contain the information about all the packets
    avgDelay = 0.0                # Initially the average delay is 0
    switchInt = SWITCHINFO(bandSwSin) # declares a variable of the class SWITCHINFO with give bandwidth

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

    pcount = 0
    simulationTime=5000
    pktTot = nSource
    lastLeftTime = 0.0
    currentTime = 0
    packet_sink = 0

    #We will iterate the loop until the pkt reaching sink is not gretaer than the simulation time
    while (packet_sink < simulationTime):
        topPacket = pq.get()
        pid = topPacket.pId
        currentTime = topPacket.currentTime

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
        # now for event 1->2 ie entering to levaing the queue

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
            avgDelay += packet[pid].queueOut-packet[pid].generationTime+flag1
            switchInt.qSize += 1
            pcount += 1

        # EVENTS2 -> EVENTS3
        # thsi is for event2->3 ie leaving the queue and reaching teh sink
        # first we decrease the queue size by 1 as the packet is now not in the queue
        # Then according to the time and packet id, and bandwidth we popuate our sink recahing time in the prioirty queu
        elif topPacket.eId == 2:
            switchInt.qSize = switchInt.qSize - 1
            lastLeftTime = currentTime
            flag2 = pktLength / bandSwSin
            sinkTime = currentTime + flag2
            packet[pid].sinkReachTime = sinkTime
            pq.put(EVENTS(3, pid, sinkTime))

        # thsis for the last stage where the packet reaches the sink
        # Here we simply increment the n of packet at sink by 1
        else:
        	packet_sink +=1

	# the average delay is the sum of all average delays divided by the total no of packets
    avgDelay = avgDelay / pcount
    return avgDelay


def main():

    print ("Enter 0 to use default value or 1 to use own")
    resp = int(input())
    if resp == 0:
        # nsource = number of source
        nSource = 4

        # bandSoSwi = bandwidth between source and switch in bit
        bandSoSwi = 2e6

        # bandSwSin = bandwidth between switch and sink in bit
        bandSwSin = 4.8e6

        # pktLength = size of each packet in bit
        pktLength = 1.2e4

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
        delay = 0
        iteration = 0
        while(iteration < totalIterations):
            delay+=avgDelayFunction(nSource, bandSoSwi, bandSwSin, pktLength, simulationTime, lamda/nSource)
            iteration+=1
        print(lamda,delay/iteration)
        y.append(delay/totalIterations)
        lamda+=15

    #temp="nSource="+str(nSource)+",bandSoSwi(bit)="+str(bandSoSwi)+"\n pktlength="+str(pktLength)+" bit\n bandSwSin(bit) ="+ str(bandSwSin)+"\nlambda = 4-1000\n"

    # plotting curve
    plt.plot(x, y)
    plt.xlabel("Lamda")
    plt.ylabel("Average Delay")
    #plt.text(4,4,temp)
    plt.title("Average delay vs Lamda")
    plt.show()


if __name__ == "__main__":
    main()
