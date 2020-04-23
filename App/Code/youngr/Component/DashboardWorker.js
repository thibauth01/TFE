import React from 'react'
import { StyleSheet,Dimensions,FlatList,TouchableOpacity,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input,Card} from 'galio-framework'
import { theme } from '../Constants';
import ItemWorksFree from './ItemWorksFree'
import { connect } from 'react-redux'

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

const dataJobsFree = [
  {
    id: '1',
    title: 'Keep my dog',
    date:'24/03/2020',
    type:'Petsitting',
    path_profile:"comment.png"
  },
  {
    id: '2',
    title: 'Jean-christophe',
    date:'24/03/2025',
    type:'Fils de pute',
    path_profile:'http://i.pravatar.cc/100?id=skater'
  },
  {
    id: '3',
    title: 'Mange tes mort',
    date:'Lundi',
    type:'Chez tes voisin',
    path_profile:'http://i.pravatar.cc/100?id=skater'
  },
  {
    id: '4',
    title: 'Yolo',
    date:'Lundi',
    type:'Chez tes voisin',
    path_profile:'http://i.pravatar.cc/100?id=skater'
  }
];




class DashboardWorker extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
    }
  }

  componentDidMount(){
    this.getDataNextWorks().then(response => this.setState({dataNextWorks : response}) );
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
  

  render() {
  const {navigate} = this.props;

    return (
        <Block  style={styles.main_container}>

          {/*<Block center style={styles.titleBlock}>
            <Text h4 color="black" style={styles.title}>Dashboard</Text>
          </Block>*/}
          
          <Block flex={4}>
            <Text h4 muted style={styles.subtitle}>Propositions</Text>
              <FlatList
                data={dataJobsFree}
                renderItem={({ item }) => <ItemWorksFree navigate={this.props.navigate} title={item.title} type={item.type} date={item.date} path_profile={item.path_profile} />}
                keyExtractor={item => item.id}
              />
              
          </Block>
          <Block flex={3}>
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
  more:{
    color:theme.COLORS.MUTED,
    fontSize:15
  }


})

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}

export default connect(mapStateToProps)(DashboardWorker)