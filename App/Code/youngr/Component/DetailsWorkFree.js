import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking, Dimensions, ScrollView, TouchableOpacity } from 'react-native'
import {Button,Text, Block, Input, Icon} from 'galio-framework'
import { theme } from '../Constants';
import {getAge,reformatDate,reformatTime,getPrice} from '../Constants/Utils'


class DetailsWorkFree extends React.Component {

  constructor(props) {
    super(props)
    this.state={
    }
  }



  render() {
    const {state} = this.props.navigation
    
    return (
        <Block style={styles.main_container}>
         
          <Block flex={1}  middle  style={styles.titlesBlock}>
              <Text style={styles.textTitle} h3>{state.params.title}</Text>
              <Text style={styles.textTitle} h5 color={theme.COLORS.SECONDARY}>{state.params.type}</Text>
          </Block>
          
          <Block flex={3} middle style={styles.contentBlock}>
            <ScrollView >
              <Block row style={styles.itemBlock}>
                <Icon  size={25} name="calendar" family="feather" color={theme.COLORS.MUTED}/>
                  <Text  style={styles.textContent}>{reformatDate(state.params.date_start)}</Text>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="clock" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>{reformatTime(state.params.time_start)} - {reformatTime(state.params.time_end)}</Text>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="dollar-sign" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>{getPrice(state.params.time_start,state.params.time_end,state.params.price)}€</Text>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="map-pin" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>{state.params.place}</Text>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="tag" family="feather" color={theme.COLORS.MUTED}/>
                  <Text style={styles.textContent}>{state.params.description}</Text>
              </Block>
            </ScrollView>
          </Block>
          
          <Block row flex={0.5} space="evenly">
           <Button style={styles.buttonDelete}>Supprimer</Button>
            
          </Block>
        </Block>
    )
  }
}

const styles = StyleSheet.create({
  test:{
    backgroundColor:'red',
    
  },
  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND
    
  },
  headerBlock:{
    flexDirection:"row",
    backgroundColor:theme.COLORS.DEFAULT,
    shadowColor: "#000",
    shadowOffset: {
        width: 0,
        height: 1,
    },
    shadowOpacity: 0.20,
    shadowRadius: 1.41,

    elevation: 5,
  },
  profile:{
    borderRadius:200,
    height:100,
    width:100
  },
  profileBlock:{
    marginTop:15,
    marginLeft:15

  },
  infoprofileBlock:{
    paddingTop:15
  },
  
  buttonsProfile:{
    width:200,
    paddingTop:10,
    justifyContent:"space-around",
  },
  buttonProfileMessage:{
    width:80,
    height:35,
    backgroundColor: theme.COLORS.DEFAULT,
    borderBottomColor:theme.COLORS.MUTED,
    
  },
  buttonProfilePhone:{
    width:80,
    height:35,
    backgroundColor: theme.COLORS.SECONDARY
  },

  titlesBlock:{
    width:Dimensions.get("window").width,
    marginTop:10
    
  },
  textTitle:{
    textAlign:"center"
  },

  contentBlock:{
    width:Dimensions.get("window").width,
    marginRight:30,
  },
  itemBlock:{
    marginTop:15,
    marginLeft:25
  },
  textContent:{
    fontSize:18,
    marginLeft:15
  },
  progressionBlock:{
    backgroundColor:theme.COLORS.DEFAULT,
    width:80,
    height:30,
    marginLeft:80,
    borderRadius:5,
  },
  progressionText:{
    color:theme.COLORS.ERROR
  },
  buttonDelete:{
    backgroundColor:theme.COLORS.ERROR,
    width:150,
    height:35,
  },
})

export default DetailsWorkFree