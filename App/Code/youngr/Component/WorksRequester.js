import React from 'react'
import { StyleSheet,Dimensions,FlatList,TouchableOpacity,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input,Card} from 'galio-framework'
import RNPickerSelect from 'react-native-picker-select';
import DatePicker from 'react-native-datepicker'
import DateTimePicker from '@react-native-community/datetimepicker';
import { theme } from '../Constants';
import ItemWorksTodo from './ItemWorksTodo'


const dataJobsTodo= [
  {
    id: '1',
    title: 'Keep my dog',
    date_start:'2020/03/10',
    type:'Petsitting',
    path_profile:"comment.png"
  },
  {
    id: '2',
    title: 'Jean-christophe',
    date_start:'2020/09/10',
    type:'Fils de pute',
    path_profile:'http://i.pravatar.cc/100?id=skater'
  },
  {
    id: '3',
    title: 'Mange tes mort',
    date_start:'2020/06/11',
    type:'Chez tes voisin',
    path_profile:'http://i.pravatar.cc/100?id=skater'
  },
];


class DashboardRequester extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      
    }
  }

  
  
  render() {


    return (
      <Block  middle style={styles.main_container}>
        <Block flex={1} style={styles.block_content}>
            <Text h4 muted style={styles.subtitle}>Mes travaux</Text>
            <FlatList
                data={dataJobsTodo}
                renderItem={({ item }) => <ItemWorksTodo 
                                            navigate={this.props.navigate} 
                                            title={item.title} 
                                            type={item.type} 
                                            date_start={item.date_start} 
                                            path_profile={item.path_profile} 
                                          />}
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
    backgroundColor:theme.COLORS.BACKGROUND,
    
    
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
    paddingLeft:15,
    marginBottom:5
  },
  block_content:{
    width:Dimensions.get('window').width-10
  }


})

export default DashboardRequester