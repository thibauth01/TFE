import React from 'react'
import { StyleSheet,Dimensions,FlatList,TouchableOpacity,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Icon, Input,Card} from 'galio-framework'
import RNPickerSelect from 'react-native-picker-select';
import DatePicker from 'react-native-datepicker'
import DateTimePicker from '@react-native-community/datetimepicker';
import { theme } from '../Constants';
import { block } from 'react-native-reanimated';
import ItemWorksTodo from './ItemWorksTodo'
import { connect } from 'react-redux'


import {
  LineChart,
  BarChart,
  PieChart,
  ProgressChart,
  ContributionGraph,
  StackedBarChart
} from "react-native-chart-kit";

 

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





class DashboardRequester extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      itemsCount:3,
      dataNextWorks : undefined
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

        <Block flex={4}>
          <Text h4 muted style={styles.subtitle}>Prochains travaux</Text>
            <FlatList
              data={this.state.dataNextWorks == undefined ? this.state.dataNextWorks:this.state.dataNextWorks.slice(0,this.state.itemsCount)}
              renderItem={({ item }) => <ItemWorksTodo 
                                          navigate={this.props.navigate}
                                          title={item.title} 
                                          type={item.type} 
                                          date_start={item.date_start} 
                                          profile_path={item.profile_path} 
                                        />}
              keyExtractor={item => item.id}
            />
              
        </Block>
      
        <Block flex={4}>
          <Text h4 muted style={styles.subtitle}>Prochain travailleur</Text>
          <Block style={styles.nextWork_block}>
            <Block row style={{marginTop:8}}>
              <Image/>
              <Image style={styles.profile} source={require(`../Images/avatar.jpg`)}></Image>
              <Block  space="evenly" flex={1}>
                <Text h5>Marcus Rashford</Text>
                <Block row >
                  <Text muted>22 ans</Text>
                </Block>
              </Block>
              <Block middle flex={0.3}>
                <Text size={17} color={theme.COLORS.SECONDARY}>33€</Text>
              </Block>
            </Block>
            <Block  middle style={styles.title_block}>
              <Text h4> Nettoyage de tout</Text>
              <Text h6 color={theme.COLORS.SECONDARY}>Bricolage</Text>
            </Block>
            <Block style={{marginTop:20}}>
              <Block row style={styles.itemBlock} space="between">
                <Block row>
                  <Icon  size={25} name="calendar" family="feather" color={theme.COLORS.MUTED}/>
                  <Text  style={styles.textContent}>20 Mars 2020</Text>
                </Block>
                <Block row right style={{marginRight:10}}>
                  <Icon size={25} name="clock" family="feather" color={theme.COLORS.MUTED}/>
                  <Text style={styles.textContent}>20h30 - 22h30</Text>
                </Block>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="map-pin" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>3 Rue des cochons 6440 Louvain la Neuve Belgique Afrique mon cul </Text>
              </Block>
            </Block>
          </Block>
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
    width: Dimensions.get('window').width - 10
    
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
  }


})

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}

export default connect(mapStateToProps)(DashboardRequester)