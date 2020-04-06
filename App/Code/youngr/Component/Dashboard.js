import React from 'react'
import { StyleSheet,Dimensions,FlatList,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input,Card} from 'galio-framework'
import { theme } from '../Constants';
import {
  LineChart,
  BarChart,
  PieChart,
  ProgressChart,
  ContributionGraph,
  StackedBarChart
} from "react-native-chart-kit";

function ItemJobsFree({ title,type,date}){
  return (
    <Block style={styles.itemJobFree}>
      <Card
      borderless
        style={styles.cardJobFree}
        title={title}
        caption={type}
        captionColor={theme.COLORS.SECONDARY}
        location={date}
        avatar="http://i.pravatar.cc/100?id=skater"
      />
    </Block>
  );
}

const dataJobsFree = [
  {
    id: '1',
    title: 'Keep my dog',
    date:'24/03/2020',
    type:'Petsitting'
  },
  {
    id: '2',
    title: 'Ferme ta geuele',
    date:'24/03/2025',
    type:'Fils de pute'
  },
  {
    id: '3',
    title: 'Mange tes mort',
    date:'Lundi',
    type:'Chez tes voisin'
  },
];




class Dashboard extends React.Component {

  constructor(props) {
    super(props)
    this.state = {

    }
  }


  render() {
    
   
    return (
        <Block  style={styles.main_container}>

          <Block>
            <Text h4 color="black" style={styles.title}>Dashboard</Text>
          </Block>
          
          <Block flex={2}>
              <FlatList
                data={dataJobsFree}
                renderItem={({ item }) => <ItemJobsFree title={item.title} type={item.type} date={item.date} />}
                keyExtractor={item => item.id}
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
  title:{
    paddingTop:20,
    paddingLeft:30,
    marginBottom:20
  },
  itemJobFree:{
    marginBottom:5,
    backgroundColor:"white"
  },
  cardJobFree:{
    shadowColor: "#000",
    shadowOffset: {
        width: 0,
        height: 1,
    },
    shadowOpacity: 0.20,
    shadowRadius: 1.41,

    elevation: 2,
    height:70
  }


})

export default Dashboard