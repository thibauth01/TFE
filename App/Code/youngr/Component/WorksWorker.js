import React from 'react'
import { StyleSheet,Dimensions,FlatList,TouchableOpacity,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input,Card} from 'galio-framework'
import RNPickerSelect from 'react-native-picker-select';
import DatePicker from 'react-native-datepicker'
import DateTimePicker from '@react-native-community/datetimepicker';
import { theme } from '../Constants';
import { block } from 'react-native-reanimated';
import ItemWorksTodo from './ItemWorksTodo'



const dataJobsTodo= [
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


class WorksRequester extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      date:new Date(),
      picker:false
    }
  }

  
  
  render() {

   
  const {navigate} = this.props;
  const { date } = this.state;


    return (
      <Block  style={styles.main_container}>

        <Block flex={4}>
            <Text h4 muted style={styles.subtitle}>Travaux à Faire</Text>
              <FlatList
                data={dataJobsTodo}
                renderItem={({ item }) => <ItemWorksTodo navigate={this.props.navigate} title={item.title} type={item.type} date={item.date} path_profile={item.path_profile} />}
                keyExtractor={item => item.id}
              />
              <TouchableOpacity style={{alignItems:"center"}}>
              <Block middle>
                <Text style={styles.more}>Voir plus</Text>
              </Block>
              </TouchableOpacity>
              
          </Block>
      
      
        <Block flex={3}>
          <Text h4 muted style={styles.subtitle}>Travaux donnés</Text>
          
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

export default WorksRequester