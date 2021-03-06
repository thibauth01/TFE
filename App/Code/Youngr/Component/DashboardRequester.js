import React from 'react'
import { StyleSheet,Dimensions,FlatList,TouchableOpacity,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Icon, Input,Card} from 'galio-framework'
import { theme } from '../Constants';
import { block } from 'react-native-reanimated';
import { connect } from 'react-redux'
import CardWorkTakeReq from './CardWorkTakeReq';
import {getAge,reformatDate,reformatTime,getPrice} from '../Constants/Utils'
import { NavigationEvents } from 'react-navigation';
import NetInfo from '@react-native-community/netinfo'
import {Toast} from 'native-base'



 

const data = {
  labels: ["January", "February", "March", "April", "May", "June"],
  datasets: [
    {
      data: [20, 45, 28, 80, 99, 43]
    }
  ]
};

const chartConfig = {
  backgroundGradientFrom: "#1E2923",
  backgroundGradientFromOpacity: 0,
  backgroundGradientTo: "#08130D",
  backgroundGradientToOpacity: 0.5,
  color: (opacity = 1) => `rgba(26, 255, 146, ${opacity})`,
  strokeWidth: 2, // optional, default 3
  barPercentage: 0.5
};



const { width } = Dimensions.get('window');


class DashboardRequester extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      itemsCount:3,
      dataNextWorks : undefined,
      dateNotPassed : undefined,
      
    }
  }

 
 
  componentDidMount(){
    

    if (this.props.connected) {
      this.getDataNextWorks().then(response => this.setState({dataNextWorks : response},() => {
        this.setState({dateNotPassed : this.removeDatePassed()},()=>{
          const action = { type: "GET_NEXT_WORK", value: this.state.dateNotPassed}
          this.props.dispatch(action);
        })
      })); 
    }
    this.setState({
      dateNotPassed:this.props.nextWork
    }) 
    
    
    
    
  }

  
  

  getDataNextWorks(){
    
      return fetch('https://dashboard.youngr.be/api/nextWorks.php',{
      method:'POST',
      header:{
        'Accept': 'application/json',
        'Content-type': 'application/json'
      },
      body:JSON.stringify({
        type: this.props.account.type,
        idAccount: this.props.account.id,
        jwt:this.props.account.jwt
      })
      
    })
    .then((response) => response.json())
     .then((responseJson)=>{
      return responseJson.data;
       
     })
     .catch((error)=>{
        console.error(error);
     });
    
    

     
  }

  removeDatePassed(){

    var newTab = [];

    for (let index = 0; index < this.state.dataNextWorks.length; index++) {

      const elem = this.state.dataNextWorks[index];

      const dateItem= new Date(elem.date_start);
      const now = new Date();
      const dat1 = dateItem.getFullYear() + dateItem.getMonth() + dateItem.getDate();
      const dat2 = now.getFullYear() + now.getMonth() + now.getDate();


      if(dat1 >= dat2){
        newTab.push(elem);
      }
 
    }
    return newTab;
  }

  isWorks(){

    if(this.state.dateNotPassed != undefined){
      if(this.state.dateNotPassed.length > 0){
        return(
          <Block middle>
            <FlatList
              data={this.state.dateNotPassed.slice(0,this.state.itemsCount)}
              renderItem={({ item }) => <CardWorkTakeReq 
                                          navigate={this.props.navigate}
                                          item={item}
                                        />}
              keyExtractor={item => item.id}
            />
          </Block>
        )
      }
      else{
        return(
          <Block middle style={styles.noWork}>
            <Text h5> Aucun travail de prévu</Text>
          </Block>
          
        )
      }
    }
  }

  isWorker(){
    

    if(this.state.dateNotPassed != undefined){
      if(this.state.dateNotPassed.length > 0){
        const elem = this.state.dateNotPassed[0]
        const path = `https://dashboard.youngr.be/`+ elem.profile_path;
        
        return(
           
          <Block style={styles.nextWork_block}>
            <Block row style={{marginTop:8}}>
              <Image style={styles.profile} source={{uri:path}} />
              <Block  space="evenly" flex={1}>
                <Text h5>{elem.first_name} {elem.last_name}</Text>
                <Block row >
                  <Text muted>{getAge(elem.birth_date)} ans</Text>
                </Block>
              </Block>
              <Block middle flex={0.3}>
                <Text size={17} color={theme.COLORS.SECONDARY}>{getPrice(elem.time_start,elem.time_end,elem.price)}€</Text>
              </Block>
            </Block>
            <Block  middle style={styles.title_block}>
              <Text h4>{elem.title}</Text>
              <Text h6 color={theme.COLORS.SECONDARY}>{elem.type}</Text>
            </Block>
            <Block style={{marginTop:20}}>
              <Block row style={styles.itemBlock} space="between">
                <Block row>
                  <Icon  size={25} name="calendar" family="feather" color={theme.COLORS.MUTED}/>
                  <Text  style={styles.textContent}>{reformatDate(elem.date_start)}</Text>
                </Block>
                <Block row right style={{marginRight:10}}>
                  <Icon size={25} name="clock" family="feather" color={theme.COLORS.MUTED}/>
                  <Text style={styles.textContent}>{reformatTime(elem.time_start)} - {reformatTime(elem.time_end)}</Text>
                </Block>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="map-pin" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>{elem.place} </Text>
              </Block>
            </Block>
          </Block>
        )

      }
      else{
        return(
          <Block middle style={styles.noWork}>
            <Text h5> Aucun travail de prévu</Text>
          </Block>
          
        )
      }
    }
  }



  
  render() {

    

    return (
      
      <Block  style={styles.main_container}>
        
        <NavigationEvents
                onDidFocus={() => this.componentDidMount()}
            />
        <Block >
          <Text h4 muted style={styles.subtitle}>Prochains travaux</Text>
            {this.isWorks()}   
        </Block>
      
        <Block>
          <Text h4 muted style={styles.subtitle}>Prochain travail</Text>
          {this.isWorker()}
        </Block>

    </Block>
    )
  }
}

const styles = StyleSheet.create({
  test:{
    backgroundColor:'red'
  },
  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND,
    width: Dimensions.get('window').width 
    
  },
  titleBlock:{
    width:Dimensions.get('window').width,
    backgroundColor:theme.COLORS.DEFAULT,
    height:60,
    marginBottom:5
  },
  title:{
    paddingTop:15,
    paddingLeft:20,
    fontWeight:"bold"
  },
  subtitle:{
    marginTop:10,
    paddingLeft:10,
    marginBottom:5
  },

  nextWork_block:{
    backgroundColor:theme.COLORS.DEFAULT,
    borderRadius:5,
    
  },
  profile:{
    borderRadius:15,
    height:60,
    width:60,
    marginTop:5,
    marginLeft:10,
    marginRight:30
  },
  title_block:{
    marginTop:20
  }, 
  itemBlock:{
    marginTop:10,
    marginBottom:12,
    marginLeft:10
  },

  textContent:{
    paddingTop:2,
    fontSize:15,
    marginLeft:10
  },
  noWork:{
    marginBottom:10,
    backgroundColor:theme.COLORS.DEFAULT,
    marginLeft:10,
    height:50,
    borderRadius:10,
    width:Dimensions.get("window").width-20
  },
  offlineContainer: {
    backgroundColor: '#b52424',
    height: 35,
    justifyContent: 'center',
    alignItems: 'center',
    flexDirection: 'row',
    width,
    position: 'absolute',
    bottom: 0
  },
  offlineText: { 
    color: '#fff'
  }


})

const mapStateToProps = (state) =>{
  console.log(state);
  return {
      account: state.account.account,
      nextWork: state.nextWork.nextWork
      
  }
}

export default connect(mapStateToProps)(DashboardRequester)