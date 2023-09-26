//these connect the ultrasonic trigpin and ecopin
//to the arduino board port 12 and 13
#define trigPin 12
#define echoPin 13

//these are used to connect the motor driver to arduino board
#define motorA1 10
#define motorA2 9
//vcc is defined at port11
#define vcc 11

void setup() {
Serial.begin (9600);
//here the outputs and inputs are declared
pinMode(trigPin, OUTPUT);
pinMode(echoPin, INPUT);
pinMode(motorA1, OUTPUT);
pinMode(motorA2, OUTPUT);
pinMode(vcc, OUTPUT);
digitalWrite(vcc, HIGH);
}

void loop() {
 //duration and distance are defined for the ultrasonic sensor
long duration, distance;

//when trigpin is low it is on off condition
//and it tajes 2 microseconds hault
digitalWrite(trigPin, LOW);
delayMicroseconds(2);

//in high condition it is on
//and sends 10 microsecond wave
//to measure the distance
digitalWrite(trigPin, HIGH);
delayMicroseconds(10);
digitalWrite(trigPin, LOW);
duration = pulseIn(echoPin, HIGH);

//distance is calculated by dividing 
//with the speed of sound
//in cm/s units
distance = (duration/2) / 29.1;

//if the distnace is less than 10cm
//we enter this if loop
if (distance < 10) {
Serial.println("The distance is less than 10");

//motor A1 is set to high 
//and motor A2 is set to low
//This is basically the on position of the motor
//and here is gives the pump the current 
//and sanitiser is pumped out
digitalWrite(motorA1, HIGH);
digitalWrite(motorA2, LOW);

//it also prints the distance
Serial.print(distance);
Serial.println(" cm");
delay(10);
//after one pump it will be tured off
//and detect again if hand is still there or not
digitalWrite(motorA1, LOW);
digitalWrite(motorA2, LOW);
}

//if distance is greater than 10cm
//it enters the else loop
else {
Serial.println("The distance is more than 10 ");

//both the motor are in low mode
//and power is not given to the pump
//and the ultrasonic sensor again 
//checks the distance and the process is continousely run
digitalWrite(motorA1, LOW); 
digitalWrite(motorA2, LOW);
Serial.print(distance);
Serial.println(" cm");
}
}
