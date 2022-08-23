// Type your code here, or load an example.
sbit sensor1=p1^0;
sbit sensor2=p1^1;
sbit sensor3=p1^2;
sbit load1=p2^0;
sbit load2=p2^1;
sbit load3=p2^2;
void main(){
  load1=load2=load3=0;
  sensor1=sensor2=sensor3=0;
  while(1)
  {
  	if(sensor1==1)
    {
    load1=1;
    load2=0;
    load3=0;
    }
    if(sensor2==1)
    {
    load1=0;
    load2=1;
    load3=0;
    }
     if(sensor3==1)
    {
    load1=0;
    load2=0;
    load3=1;
    }
    }
  }