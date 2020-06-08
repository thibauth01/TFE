import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking, Dimensions, ScrollView, TouchableOpacity } from 'react-native'
import {Button,Text, Block, Input, Icon} from 'galio-framework'
import { theme } from '../Constants';
import {getAge,reformatDate,reformatTime,getPrice} from '../Constants/Utils'
import AwesomeAlert from 'react-native-awesome-alerts';
import { connect } from 'react-redux'



class DetailsWorkProposal extends React.Component {

  constructor(props) {
    super(props)
    this.state={
      showAlert:false,
      typeAlert:undefined
    }
  }

  showAlert = () => {
    
    this.setState({
      showAlert: true,
      typeAlert:true
    });
    
  
    
  };

  hideAlert = () => {
    this.setState({
      showAlert: false
    });
  };

 


  accept=()=>{
    const idWork = this.props.navigation.state.params.id;

    fetch('http://192.168.1.57/TFE/Web/plateform/api/acceptWork.php',{
      method:'POST',
      header:{
          'Accept': 'application/json',
          'Content-type': 'application/json'
      },
      body:JSON.stringify({
          idWork: idWork,
          idTypeAccount: this.props.account.idTypeAccount,
          firstName:this.props.account.first_name,
          lastName:this.props.account.last_name
      })
      
    })
    .then((response) => response.json())
        .then((responseJson)=>{
            if(!responseJson.status){
              alert("impossible de supprimer")
            };
        
        })
        .catch((error)=>{
            console.error(error);
        }); 
  }


  render() {
    const {state} = this.props.navigation
    console.log(this.props.account);
    
    return (
        <Block style={styles.main_container}>
          <Block flex={1.2} style={styles.headerBlock}>
            <Block flex={1} style={styles.profileBlock}>
              <Image style={styles.profile} source={require(`../Images/avatar.jpg`)}></Image>
            </Block>
            <Block flex={2} style={styles.infoprofileBlock}>
              <Block row style={{marginLeft:10}}>
                <Text h4 muted>{state.params.first_name} {state.params.last_name}</Text> 
              </Block> 
              <Block row space="around" width={200}>
                <Text muted > {getAge(state.params.birth_date)} ans</Text>
                <Text muted> {state.params.city}</Text>
              </Block>
              <Block row style={styles.buttonsProfile}>
                <Button onPress={()=>{Linking.openURL(`tel:${state.params.phone}`)}} style={styles.buttonProfilePhone}  iconColor={theme.COLORS.DEFAULT}	onlyIcon iconSize={20} icon="phone" iconFamily="feather" flex={2}></Button>
              </Block>      
            </Block>
          </Block>
          <Block flex={0.9} space="evenly" center fluid style={styles.titlesBlock}>
              <Text style={styles.textTitle} h3>{state.params.title}</Text>
              <Text style={styles.textTitle} h5 color={theme.COLORS.SECONDARY}>{state.params.type}</Text>
          </Block>
          
          <Block flex={2.5} style={styles.contentBlock}>
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
          
          <Block row flex={0.6} space="evenly">
           <Button style={styles.buttonAccept} onPress={this.showAlert.bind()} >Accepter</Button>
            
          </Block>
          <AwesomeAlert
            show={this.state.showAlert}
            showProgress={false}
            title={"Effectuer ce travail"}
            message="Etes vous sûr?"
            closeOnTouchOutside={true}
            closeOnHardwareBackPress={false}
            showCancelButton={true}
            showConfirmButton={true}
            cancelText="Non"
            confirmText={"Oui, Je veux le faire"}
            confirmButtonColor={theme.COLORS.SECONDARY}
            onCancelPressed={() => {
              this.hideAlert();
            }}
            onConfirmPressed={() => {
              this.accept();
              this.hideAlert();
              this.props.navigation.goBack();
            }}
          />
          
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
    justifyContent:"center",
  },
  buttonProfileMessage:{
    width:80,
    height:35,
    backgroundColor: theme.COLORS.DEFAULT,
    borderBottomColor:theme.COLORS.MUTED,
    
  },
  buttonProfilePhone:{
    width:150,
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
    backgroundColor:theme.COLORS.MUTED,
    width:100,
    height:35,
  },
  buttonAccept:{
    backgroundColor:theme.COLORS.SECONDARY,
    width:170,
    height:35,
  }
})

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}

export default connect(mapStateToProps)(DetailsWorkProposal)