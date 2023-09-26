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
    def __init__(self, sid, bandSoSwi,packetGenerate):
        self.sourceId = sid         # Every Source has a unique source id
        self.bandSoSwi = bandSoSwi  # It is the bandwidth of source to switch
        self.rate = packetGenerate

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

packetDropList = []   # A list to maintain the packet drops
fixQueueSize = 10

# function to avg packet loss rate
# now as we have taken the queue size to be fixed
# So after a particular no of entries the queue will stop the entering of packets even if the sourse is sending them

def avgPacketLossFunction(nSource, bandSoSwi, bandSwSin, pktLength, simulationTime,source):
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
    packet_sink = 0
    simulationTime=5000

    packetDrop = []
    packet_arrived = []
    for i in range(len(source)):
        packetDrop.append(0)
        packet_arrived.append(0)

    #We will iterate the loop until the pkt reaching sink is not gretaer than the simulation time
    while (packet_sink < simulationTime):
        topPacket = pq.get()
        pid = topPacket.pId
        currentTime = topPacket.currentTime
        sourceId = packet[pid].sourceId

        # EVENTS 0 -> (EVENTS0,EVENTS1)
        # first we see for our event 0->1 ie genration of packet and reaching the queue
        # here we take the rate of generation rate as given in the array and then append in packet array the details of the packet
        # after that we increment totalpackets with 1 and we populate our priority queue for the record
        # At last we give our queue the data of current time + our packetlength/ bandwidth of that stage
        if topPacket.eId == 0:
            nextVarTime = nextTime(source[sourceId].rate)
            pq.put(EVENTS(0, pktTot, currentTime + nextVarTime))
            packet.append(PACKETINFO(pktTot, currentTime + nextVarTime, packet[pid].sourceId))
            pktTot += 1
            flagSoSwi = pktLength / bandSoSwi
            pq.put(EVENTS(1, pid, currentTime + flagSoSwi))
            packet[pid].queueIn = currentTime + flagSoSwi

        # EVENTS 1 -> EVENTS2
        # now for event 1->2 ie entering to leaving the queue
        # we first increment the arrived packets by 1
        # then we see if our queue has reached the upper limit or not
        # if yes then we simply drop the packet
        # but if no then we enter the information about the packet in our priority queue
        # such as the reaching time and the additional time for the packet since the last packet left

        elif topPacket.eId == 1:
            packet_arrived[sourceId] += 1
            if(switchInt.qSize>=fixQueueSize):
            	packetDrop[sourceId]+=1
            else:
                reachTime = switchInt.qSize*pktLength
                reachTime = reachTime/bandSwSin
                addTime = 0
                flag1 = pktLength/bandSwSin
                if packet[pid].queueIn - lastLeftTime < flag1:
                    addTime = max(0, flag1 - (packet[pid].queueIn - lastLeftTime))
                if lastLeftTime == 0:
                    addTime = 0
                pq.put(EVENTS(2, pid, currentTime + reachTime + addTime))
                packet[pid].queueOut = currentTime + reachTime + addTime
                switchInt.qSize += 1

        # EVENTS2 -> EVENTS3
        # thsi is for event2->3 ie leaving the queue and reaching teh sink
        # first we decrease the queue size by 1 as the packet is now not in the queue
        # Then according to the time and packet id, and bandwidth we popuate our sink recahing time in the queue
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

	# packet drop Rate is simply the total no of Packets drop divided by the total no of Packets Arrived
    for i in range(nSource):
        packetDropList[i].append(packetDrop[i]/packet_arrived[i])


def main():

    print ("Enter 0 to use default value or 1 to use own")
    resp = int(input())
    if resp == 0:
        # nsource = number of source
        nSource = 4

        # bandSoSwi = bandwidth between source and switch in bit
        bandSoSwi = 2*12000*16

        # bandSwSin = bandwidth between switch and sink in bit
        bandSwSin = 2.e4

        # pktLength = size of each packet in bit
        pktLength = 1.2e4

        #packetGenerate = packet genrate
        packetGenerate = [0.9,2,4,16]

        #simulation time
        simulationTime = 5000
    else :
        packetGenerate = []
        nSource = int(input("Enter The Number of Sources :"))
        bandSoSwi = float(input("Enter the bandwdth between the Source and switch(bandSoSwi) in bit:"))
        bandSwSin = float(input("Enter the bandwidth between the switch and sink(bandSwSin) in bit:"))
        pktLength = int(input("Enter the packet length in bit(pktlength) :"))
        simulationTime =int(input("Enter the Simulation time:"))
        for i in range(nSource):
            print("Source ",i)
            l = int(input("Enter lambda for source "))
            packetGenerate.append(l)

    # creating source object
    source = []
    for i in range(nSource):
        source.append(SOURCEINFO(i, bandSoSwi,packetGenerate[i]))
        packetDropList.append([])

    iteration = 0
    while iteration < 200:
        avgPacketLossFunction(nSource, bandSoSwi, bandSwSin, pktLength, simulationTime, source)
        print(iteration)
        iteration+=1

    tempList = []
    for i in range(nSource):
        tempList.append("Source "+str(i))

    # plotting curve
    plt.xlabel("Sources")
    plt.ylabel("Time Unit")
    plt.title("Average Packet Drop for Each Source")
    plt.boxplot(packetDropList,labels=tempList)
    plt.show()


if __name__ == "__main__":
    main()
