import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input} from 'galio-framework'
import { theme } from '../Constants';



class Login extends React.Component {

  constructor(props) {
    super(props)
    this.state = {

    }
  }

  render() {
    const {navigate} = this.props.navigation;
    return (
      <Block middle  style={styles.main_container}>
          <Block center style={styles.block_login}>
            <Text flex={2}h2 color={theme.COLORS.PRIMARY} style={styles.titleH2}>Connecte toi !</Text>
            <Block  middle flex={3}>
                <Block middle width={250} >
                    <Input 
                        style={styles.input}
                        placeholder="Nom d'utilisateur" 
                        right
                        borderless
                        icon="user"
                        family="antdesign"
                        iconColor={theme.COLORS.SECONDARY}
                    />
                </Block>
                <Block  width={250}>
                    <Input 
                        style={styles.input}
                        placeholder="Mot de passe" 
                        borderless
                        right
                        password
                        viewPass
                    />
                </Block>
            </Block>
            <Block middle flex={2}>
                <Button
                    radius={10}
                    size={300}
                    color={theme.COLORS.SECONDARY}
                    onPress={() => navigate('Main')}
                >
                    Connexion
                </Button>
            </Block>
            <Block middle flex={1}>
                <Text>Pas encore de compte ?</Text><Text color={theme.COLORS.SECONDARY} onPress={ ()=> Linking.openURL('https://google.com') }>Inscris toi !</Text>
            </Block>
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
  titleH2:{
      paddingTop:15
  },

  block_login:{
    backgroundColor:theme.COLORS.DEFAULT,
    height:380,
    width:300,
    borderRadius:15,
    shadowColor: "#000",
    shadowOffset: {
        width: 0,
        height: 1,
    },
    shadowOpacity: 0.20,
    shadowRadius: 1.41,

    elevation: 2,
        
        
    },

    input:{
        height:55,
        paddingLeft:20,
        shadowColor: "#000",
        shadowOffset: {
            width: 0,
            height: 1,
        },
        shadowOpacity: 0.20,
        shadowRadius: 1.41,

        elevation: 2,
    },


 

})

export default Login