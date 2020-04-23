import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking, Dimensions, ScrollView, TouchableOpacity } from 'react-native'
import {Button,Text, Block, Input, Icon} from 'galio-framework'
import { theme } from '../Constants';


class DetailsWorksFree extends React.Component {

  constructor(props) {
    super(props)
  }


  render() {
    const {state} = this.props.navigation;
    
    return (
        <Block style={styles.main_container}>
          <Block flex={1.2} style={styles.headerBlock}>
            <Block flex={1} style={styles.profileBlock}>
              <Image style={styles.profile} source={require(`../Images/avatar.jpg`)}></Image>
            </Block>
            <Block flex={2} style={styles.infoprofileBlock}>
              <Block row  space="around" width={200}>
                <Text h3 muted>{state.params.title}</Text> 
                <Text h3 muted> S</Text>
              </Block> 
              <Block row space="around" width={200}>
                <Text muted > 22 ans</Text>
                <Text muted> Louvain-la-Neuve</Text>
              </Block>
              <Block row style={styles.buttonsProfile}>
                <Button style={styles.buttonProfileMessage}  iconColor={theme.COLORS.SECONDARY}	onlyIcon iconSize={20} icon="message-circle" iconFamily="feather" flex={2}></Button>
                <Button style={styles.buttonProfilePhone}  iconColor={theme.COLORS.DEFAULT}	onlyIcon iconSize={20} icon="phone" iconFamily="feather" flex={2}></Button>
              </Block>      
            </Block>
          </Block>
          <Block flex={0.9} space="evenly" center fluid style={styles.titlesBlock}>
              <Text style={styles.textTitle} h3>Nettoie sale fdp</Text>
              <Text style={styles.textTitle} h5 color={theme.COLORS.SECONDARY}>Bricolage</Text>
          </Block>
          
          <Block flex={3} style={styles.contentBlock}>
            <ScrollView >
              <Block row style={styles.itemBlock}>
                <Icon  size={25} name="calendar" family="feather" color={theme.COLORS.MUTED}/>
                <Text  style={styles.textContent}>20 Mars 2020</Text>
                <Block middle style={styles.progressionBlock}>
                  <Text color={theme.COLORS.GITHUB} style={styles.progressionText}>Terminé </Text>
                </Block>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="clock" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>20h30 - 22h30</Text>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="dollar-sign" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>33€</Text>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="map-pin" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>3 Rue des cochons 6440 Louvain la Neuve </Text>
              </Block>
              <Block row style={styles.itemBlock}>
                <Icon size={25} name="tag" family="feather" color={theme.COLORS.MUTED}/>
                <Text style={styles.textContent}>3 Rue des cochons 6440 Louvain-la Neuve fuerifurieeeeeeee eeeeeeeeee eeeeeeeeeeeeegulbvreilvsjbfttd gshtrd gsht rsht </Text>
              </Block>
            </ScrollView>
          </Block>
          
          <Block row space="evenly" flex={0.5}>
            <TouchableOpacity >
              <Icon name="x" family="feather" size={25} color={theme.COLORS.ERROR}/>
            </TouchableOpacity>
            <TouchableOpacity>
              <Icon name="check" family="feather" size={25} color={theme.COLORS.SUCCESS}/>
            </TouchableOpacity>
            
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
    paddingRight:30,
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
    marginLeft:60,
    borderRadius:5,
  },
  progressionText:{
    color:theme.COLORS.SUCCESS
  },
  buttonDelete:{
    backgroundColor:theme.COLORS.ERROR,
    width:80,
    height:35,
  },
  buttonAccept:{
    backgroundColor:theme.COLORS.SUCCESS,
    width:80,
    height:35,
  }



})

export default DetailsWorksFree