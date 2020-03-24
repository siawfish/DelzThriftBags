
export const addNewAccount = (account)=>{

    return async(dispatch, getState,getFirestore)=>{
        let firestore = getFirestore()
        try {
            await firestore.collection("accounts").add({
                ...account, timestamp: firestore.FieldValue.serverTimestamp()
            })
        } catch (error) {
            
        }
        
    }
}

export const deleteAccount = (id)=>{
    return (dispatch, getState, getFirestore)=>{
        let firestore = getFirestore()
        firestore.collection("accounts").doc(id).delete()
    }
}

export const editAccount = (account)=>{
    return async(dispatch, getState, getFirestore)=>{
        let firestore = getFirestore()
        try {
            await firestore.collection("accounts").doc(account.id).update(account)
        } catch (error) {
            
        }
    }
}

export const getAllAccounts = ()=>{
    return (dispatch, getState, getFirestore)=>{
        let firestore = getFirestore()
        try {
            firestore
                .collection("accounts")
                .orderBy("timestamp", "asc")
                .onSnapshot((snapshot)=>{
                let accounts = snapshot.docs.map((doc)=>{
                    return {
                        ...doc.data(),
                        id: doc.id
                    }
                })
                dispatch({type:"UPDATE_ALL_ACCOUNTS", payload:accounts})
            })
            
        } catch (error) {
            
        }
    }
}