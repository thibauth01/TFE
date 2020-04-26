import React from 'react'
import { StyleSheet,Image,View,Platform,TouchableOpacity,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input,Card} from 'galio-framework'
import { theme } from '../Constants';
import moment from 'moment';

class ItemWorksTodo extends React.Component {

  constructor(props) {
    super(props)
    this.state = {

    }
  }

  getStatut(date){
    const dateMoment = new Date(date);
    const now = new Date();
    console.log(dateMoment.getFullYear())
    if(dateMoment >= now){
      return dateMoment.getDate() + "-" + dateMoment.getMonth() + "-" + dateMoment.getFullYear()
    }
    else{
      return dateMoment.getDate() + "-" + dateMoment.getMonth() + "-" + dateMoment.getFullYear()
    }
  }


  render() {
    const {navigate} = this.props.navigate
    const statut = this.getStatut(this.props.date_start)
    return (
  
        <TouchableOpacity
          onPress={() => navigate('DetailsWorksTodo',this.props)}>
          <Card
            borderless
            style={styles.cardWorksFree}
            title={this.props.title}
            caption={this.props.type}
            captionColor={theme.COLORS.SECONDARY}
            location={statut}
            avatar={this.props.profile_path}
          />
      </TouchableOpacity>
      
   
        
    )
  }
}

const styles = StyleSheet.create({

  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND
    
  },
  cardWorksFree:{
    shadowColor: "#000",
    shadowOffset: {
        width: 0,
        height: 1,
    },
    shadowOpacity: 0.20,
    shadowRadius: 1.41,

    elevation: 2,
    height:84,
    marginTop:5,
    marginBottom:5,
    backgroundColor:theme.COLORS.DEFAULT
  }

})

export default ItemWorksTodo