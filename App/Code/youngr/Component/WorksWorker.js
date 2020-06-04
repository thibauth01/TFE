import React from 'react'
import { StyleSheet,Dimensions,FlatList,ScrollView,TouchableOpacity,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input,Card} from 'galio-framework'
import RNPickerSelect from 'react-native-picker-select';
import DatePicker from 'react-native-datepicker'
import DateTimePicker from '@react-native-community/datetimepicker';
import { theme } from '../Constants';
import { connect } from 'react-redux'

import { block } from 'react-native-reanimated';
import ItemWorksTodo from './ItemWorksTodo'
import CardWork from './Cardwork'
import CardWorkFree from './CardWorkFree'
import CardWorkDone from './CardWorkDone'
import {getAge,reformatDate,reformatTime,getPrice,loading} from '../Constants/Utils'
import { NavigationEvents } from 'react-navigation';




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


class WorksWorker extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      dataFree:undefined,
      dataTake:undefined,
      dataDone:undefined
    }
  }

  componentDidMount(){
    this.getData().then(response => this.setState({
      dataFree : response.dataFree,
      dataTake: response.dataTake,
      dataDone: response.dataDone,
    }));
  }

  getData(){
    return fetch('http://192.168.1.56/TFE/Web/plateform/api/works.php',{
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
      return responseJson;
       
     })
     .catch((error)=>{
     console.error(error);
     });

     
  }

  worksFree(){
    var newArray=[]
    if(this.state.dataFree == null){
      this.setState({dataFree:[]})
    }
    if(this.state.dataFree != undefined){

      if(this.state.dataFree.length > 0 ){
        
        for (let i = 0; i < this.state.dataFree.length; i++) {
          const elem = this.state.dataFree[i];
          const date =  new Date(elem.date_start);
          const now = new Date()
          if(date >= now){
            newArray.push(elem);
          }
        }
    
        return(
          <FlatList
            data={newArray}
            renderItem={({ item }) => <CardWorkFree 
                                        navigate={this.props.navigate} 
                                        item={item}
                                      />}
            keyExtractor={item => item.id}
          />
        )
      }
      else{
        
        return(
          <Block middle style={styles.noWork}>
            <Text h5> Aucune proposition de travail disponible</Text>
          </Block>
          
        )
      }
      
    }
    else{
      return(
        loading()
      )
    }
    
  }

  worksTake(){
    if(this.state.dataTake == null){
      this.setState({dataTake:[]})
    }
    if(this.state.dataTake != undefined){
      if(this.state.dataTake.length > 0 ){
        return(
          <FlatList
              data={this.state.dataTake}
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
          <Block middle style={styles.noWork}>
            <Text h5> Aucun travail attribué</Text>
          </Block>
          
        )
      }
      
    }
    else{
      return(
        loading()
      )
    }
  }

  workDone(){
    if(this.state.dataDone == null){
      this.setState({dataDone:[]})
    }
    if(this.state.dataDone != undefined){
      if(this.state.dataDone.length > 0 ){
        return(
          <FlatList
              data={this.state.dataDone}
              renderItem={({ item }) => <CardWorkDone 
                                          navigate={this.props.navigate} 
                                          item={item}
                                        />}
              keyExtractor={item => item.id}
          />
        )
      }
      else{
        return(
          <Block middle style={styles.noWork}>
            <Text h5> Aucun travail terminé</Text>
          </Block>
          
        )
      }
      
    }
    else{
      return(
        loading()
      )
    }
  }
  
  render() {

   
  const {navigate} = this.props;


    return (
      <Block  style={styles.main_container}>
        <NavigationEvents
                onDidFocus={() => this.componentDidMount()}
        />
        <ScrollView>
          <Block style={styles.block_content}> 
              <Text h4 muted style={styles.subtitle}>Propositions</Text>
              {this.worksFree()} 
              
          </Block>
          <Block style={styles.block_content}>
              <Text h4 muted style={styles.subtitle}>Mes travaux pris</Text>
              {this.worksTake()}
              
          </Block>
          <Block style={styles.block_content}>
              <Text h4 muted style={styles.subtitle}>Mes travaux fait</Text>
              {this.workDone()}
          </Block>
        </ScrollView>

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
  block_content:{
    width:Dimensions.get('window').width-10,
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

export default connect(mapStateToProps)(WorksWorker)