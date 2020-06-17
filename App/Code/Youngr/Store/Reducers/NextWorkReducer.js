const initialState = { nextWork: undefined}

function nextWork(state = initialState,action) {
    let nextState
    switch (action.type){
        case 'GET_NEXT_WORK':
            
            nextState = {
                ...state,
                nextWork:action.value
            }
            return nextState
            

        default:
            return state
    }
}

export default nextWork
