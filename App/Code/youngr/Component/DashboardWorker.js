import React from 'react'
import { StyleSheet,Dimensions,FlatList,TouchableOpacity,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input,Card} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'
import CardWork from './Cardwork'
import { NavigationEvents } from 'react-navigation';
import { LineChart } from "react-native-chart-kit";


const labelsGraph=["J","F","M","A","M","J","J","A","S","O","N","D"];



class DashboardWorker extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      itemsCount:3,
      dataNextWorks : undefined,
      dateNotPassed : undefined,
      datasGraph : undefined
    }
  }

  componentDidMount(){
    this.getDataNextWorks().then(response => this.setState({dataNextWorks : response},() => {
      this.setState({dateNotPassed : this.removeDatePassed()})
    }));

    this.getSalaryWorker().then(response => this.setState({datasGraph :response}));
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
        idAccount: this.props.account.id
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

  getSalaryWorker(){
    return fetch('https://dashboard.youngr.be/api/getSalaryWorker.php',{
      method:'POST',
      header:{
        'Accept': 'application/json',
        'Content-type': 'application/json'
      },
      body:JSON.stringify({
        idWorker: this.props.account.idTypeAccount
      })
      
    })
    .then((response) => response.json())
     .then((responseJson)=>{
      return responseJson;
       
     })
     .catch((error)=>{
     console.error(error);
     });
  }

  removeDatePassed(){

    for (let index = 0; index < this.state.dataNextWorks.length; index++) {
      const elem = this.state.dataNextWorks[index];

      const dateItem= new Date(elem.date_start);
      const now = new Date();
      var newTab = [];
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
      if(this.state.dateNotPassed.length > 0 ){
        return(
          <FlatList
              data={this.state.dateNotPassed.slice(0,this.state.itemsCount)}
              renderItem={({ item }) => <CardWork 
                                          navigate={this.props.navigate}
                                          item={item}
                                        />}
              keyExtractor={item => item.id}
            />
        )
      }
      else{
        return(
          <Block style={styles.noWork}>
            <Text h5> Aucun travail de prévu</Text>
          </Block>
        )
      }
    }
    else{
      return(
        <Block middle style={styles.noWork}>
          <Text h5> Aucun travail de prévu</Text>
        </Block>
      )
    }
  }
  

  dataSalary(){
    if(this.state.datasGraph != undefined && this.state.datasGraph.length > 0){
      return this.state.datasGraph;
    }
    else{
      return[0,0,0,0,0,0,0,0,0,0,0,0];
    }
  }

  

  render() {
  const {navigate} = this.props;
    return (
        <Block  style={styles.main_container}> 
          <NavigationEvents
                  onDidFocus={() => this.componentDidMount()}
          />
          <Block flex={1}>
            <Text h4 muted style={styles.subtitle}>Prochains travaux</Text>
            {this.isWorks()}
       
          </Block>
          <Block flex={1}>
            <Text h4 muted bottom style={styles.subtitle}>Revenus</Text>
            <Block middle flex={1}>
              <LineChart
                data={{
                  labels:labelsGraph,
                  datasets: [
                    {
                      data:this.dataSalary()
                    }
                  ]
                }}
                width={(Dimensions.get("window").width)-10} // from react-native
                height={250}
                yAxisLabel="€"
                yAxisSuffix=""
                yAxisInterval={2} // optional, defaults to 1
                chartConfig={{

                  backgroundColor: theme.COLORS.SECONDARY,
                  backgroundGradientFrom: theme.COLORS.SECONDARY,
                  backgroundGradientTo: theme.COLORS.SECONDARY,
                  decimalPlaces: 0, // optional, defaults to 2dp
                  color: (opacity = 1) => `rgba(255, 255, 255, ${opacity})`,
                  labelColor: (opacity = 1) => `rgba(255, 255, 255, ${opacity})`,
                  style:{
                    
                  },
                  propsForDots: {
                    r: "2",
                    strokeWidth: "2",
                    stroke: "#fff"
                  }
                }}
                withShadow
                bezier
                style={{
                  borderRadius: 10
                }}
              />
            </Block>
          </Block>

        </Block>
    )
  }
}

const styles = StyleSheet.create({

  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND
    
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
    paddingLeft:20,
    marginBottom:5
  },
  noWork:{
    marginBottom:10,
    backgroundColor:theme.COLORS.DEFAULT,
    marginLeft:10,
    height:50,
    borderRadius:10,
    width:Dimensions.get("window").width-20
  }

})

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}

export default connect(mapStateToProps)(DashboardWorker)