const initialState = { account: undefined}

function account(state = initialState,action) {
    let nextState
    switch (action.type){
        case 'GET_ACCOUNT':
            if(action.value.type == "worker" || action.value.type == "requester"){
                nextState = {
                    ...state,
                    account:action.value
                }
                return nextState
            }
            else{
                nextState = {
                    ...state,
                    account:state.value
                }
                return nextState
            }
        break; 

        case 'LOGOUT_ACCOUNT':
            nextState = {
                ...state,
                account:initialState
            }
            return nextState

        default:
            return state
    }
}

export default account
