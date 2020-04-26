import React from 'react'
import { StyleSheet,Dimensions,FlatList,TouchableOpacity,Image,View,Platform,SafeAreaView, ImageBackground,Linking, ScrollView } from 'react-native'
import {Button,Text, Block, Input,Card} from 'galio-framework'
import RNPickerSelect from 'react-native-picker-select';
import DatePicker from 'react-native-datepicker'
import DateTimePicker from '@react-native-community/datetimepicker';
import { theme } from '../Constants';
import { connect } from 'react-redux'
import ItemWorksTodo from './ItemWorksTodo'
import CardWork from './Cardwork';
import CardWorkNotAttributed from './CardWorkNotAttributed';
import {getAge,reformatDate,reformatTime,getPrice,loading} from '../Constants/Utils'






class WorksRequester extends React.Component {

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
    if(this.state.dataFree != undefined){
      if(this.state.dataFree.length > 0){
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
            renderItem={({ item }) => <CardWorkNotAttributed 
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
            <Text h5> Creez de nouveaux travaux !</Text>
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
    if(this.state.dataTake != undefined){
      if(this.state.dataTake.length > 0){
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
            <Text h5> Aucun travail de pris</Text>
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
    if(this.state.dataDone != undefined){
      if(this.state.dataDone.length > 0){
        return(
          <FlatList
              data={this.state.dataDone}
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
            <Text h5> Aucun travail de terminé</Text>
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


    return (
      <Block style={styles.main_container}>
        <ScrollView>
          <Block  style={styles.block_content}> 
              <Text h4 muted style={styles.subtitle}>Mes travaux libres</Text>
              {this.worksFree()} 
              
          </Block>
          <Block  style={styles.block_content}>
              <Text h4 muted style={styles.subtitle}>Mes travaux pris</Text>
              {this.worksTake()}
              
          </Block>
          <Block  style={styles.block_content}>
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
  subtitle:{
    marginTop:10,
    paddingLeft:15,
    marginBottom:5
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

export default connect(mapStateToProps)(WorksRequester)