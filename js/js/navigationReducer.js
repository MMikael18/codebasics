// actions
export const SET_CATEGORY   = 'SET_CATEGORY';
export const SET_TAG   = 'SET_TAG';

export function setCategory({ category }) {
  return {
    type: SET_CATEGORY,
    payload: {
      category,
      tag: ''
    },
  }
}

export function setTag({ tag }) {
  return {
    type: SET_TAG,
    payload: {
      tag
    },
  }
}

// Reducer
const initialState = {
    category: '',
    tag: ''
};

export default function(state = initialState, action) {
  console.log('reducer', state, action);

  switch (action.type) {
    case SET_CATEGORY:
      let category = action.payload;
      return Object.assign({}, state, category);
    case SET_TAG:
        let tag = action.payload;
        return Object.assign({}, state, tag);
    default:
      return state;
  }
}
