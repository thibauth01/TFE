import React from 'react'
import { StyleSheet,Dimensions,FlatList,TouchableOpacity,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input,Card} from 'galio-framework'
import { theme } from '../Constants';
import ItemWorksFree from './ItemWorksFree'
import { connect } from 'react-redux'
import CardWork from './Cardwork'

import {
  LineChart,
  BarChart,
  PieChart,
  ProgressChart,
  ContributionGraph,
  StackedBarChart
} from "react-native-chart-kit";


const labelsGraph=["J","F","M","A","M","J","J","A","S","O","N","D"];
const datasGraph=[
  {
    data: [
      Math.random() * 10,
      Math.random() * 10,
      Math.random() * 10,
      Math.random() * 10,
      Math.random() * 10,
      Math.random() * 10,
      Math.random() * 10,
      Math.random() * 10,
      Math.random() * 10,
      Math.random() * 10,
      Math.random() * 10,
      Math.random() * 10
    ]
  }
];


class DashboardWorker extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      itemsCount:3,
      dataNextWorks : undefined,
      dateNotPassed : undefined
    }
  }

  componentDidMount(){
    this.getDataNextWorks().then(response => this.setState({dataNextWorks : response},() => {
      this.setState({dateNotPassed : this.removeDatePassed()})
    }));
  }

  getDataNextWorks(){

    return fetch('http://192.168.1.56/TFE/Web/plateform/api/nextWorks.php',{
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
  }

  render() {
  const {navigate} = this.props;

    return (
        <Block  style={styles.main_container}> 
          <Block flex={1}>
            <Text h4 muted style={styles.subtitle}>Prochains travaux</Text>
            {this.isWorks()}
       
          </Block>
          <Block flex={1.2}>
            <Text h4 muted style={styles.subtitle}>Revenus</Text>
            <LineChart
              data={{
                labels:labelsGraph,
                datasets: datasGraph
              }}
              width={(Dimensions.get("window").width)-10} // from react-native
              height={220}
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
    marginBottom:10
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