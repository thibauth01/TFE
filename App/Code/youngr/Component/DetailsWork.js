import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input} from 'galio-framework'
import { theme } from '../Constants';


class Message extends React.Component {

  constructor(props) {
    super(props)
  }


  render() {
    const {state} = this.props.navigation;
    return (
        <Block middle style={styles.main_container}>
          <Block flex={1} style={styles.headerBlock}>
            <Block flex={1} style={styles.profileBlock}>
              <Image style={styles.profile} source={require(`../Images/testProfile.jpeg`)}></Image>
            </Block>
            <Block  flex={2} style={styles.infoprofileBlock}>
              <Block row>
                <Text h3 color={theme.COLORS.MUTED}>Jason</Text> 
                <Text h3 color={theme.COLORS.MUTED}> Statam</Text>
              </Block> 
              <Block row>
                <Text> 22 ans</Text>
                <Text> Louvain-la-Neuve</Text>
              </Block>
              <Block row>
                <Button> Message</Button>
                <Button> Phone</Button>
              </Block>      
            </Block>
          </Block>
          <Block flex={1} style={styles.titleBlock}>

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
  headerBlock:{
    flexDirection:"row"
  },
  profile:{
    borderRadius:200
  },
  profileBlock:{
    marginTop:15,
    marginLeft:15

  },
  infoprofileBlock:{

  },
  titleBlock:{

  }

})

export default Message