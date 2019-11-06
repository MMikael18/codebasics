import "babel-polyfill"
import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

import { createStore } from 'redux';
import { Provider } from 'react-redux'

import { useDispatch, useSelector } from "react-redux";

import rootReducer from './rootReducer';
import { setCategory, setTag } from "./navigationReducer";

const store = createStore( rootReducer );

function Tag_navigation() {
    // store
    const category = useSelector(state => state.navigation.category);
    const tag = useSelector(state => state.navigation.tag);
    const dispatch = useDispatch();
    // local
    const [categories, setCategories] = useState([])
    const [tags, setTags] = useState([])
    // Similar to componentDidMount and componentDidUpdate:
    useEffect(() => {

        const fetchData = async () => {
            const result = await axios(
                '/wp-admin/admin-ajax.php?action=get_categories&_wpnonce=' + window.custom_nonce,
            )
            setCategories(result.data)
        }
        fetchData()

        const fetchTags = async () => {
            const result = await axios({
                method: 'post',
                url: '/wp-admin/admin-ajax.php?action=get_tags&_wpnonce=' + window.custom_nonce,
                data: { category: category },
                config: { headers: { 'Content-Type': 'application/json' }}
              }
            )
            setTags(result.data)
        }
        fetchTags()

    },[category]);

    return (
        <div className="c-wall-navigation" style={{color: 'white'}}>
            <ul>
                {categories.map(item => (
                <li key={item.slug} className={item.slug == category ? 'active' : '' }>
                    <span onClick={() => dispatch(setCategory({ category: item.slug == category ? '' : item.slug }))} >{item.name}</span> 
                </li> 
                ))}
            </ul>
            <ul>
                {tags.map(item => (
                <li key={item.slug} className={item.slug == tag ? 'active' : '' }>
                    <span onClick={() => dispatch(setTag({ tag: item.slug == tag ? '' : item.slug  }))} >{item.name}</span>
                </li>
                ))} 
            </ul>
        </div>
    );
}

function Post_wall() {
    const category = useSelector(state => state.navigation.category);
    const tag      = useSelector(state => state.navigation.tag);

    const [content, setContent] = useState([])

    useEffect(() => {

        const fetchContent = async () => {
            const result = await axios({
                method: 'post',
                url: '/wp-admin/admin-ajax.php?action=get_posts&_wpnonce=' + window.custom_nonce,
                data: { 
                    category: category,
                    tag: tag 
                },
                config: { headers: { 'Content-Type': 'application/json' }}
              }
            )
            setContent(result.data)
        }
        fetchContent()

    },[category, tag]);

    return (
        <div className="c-post-wall">
            <div className="c-post-wall-content">
                {content.map(item => (                
                    <article className="c-post-wall__item" key={item.id}>
                        <a href={item.url} key={item.id}>
                            <small className="c-post-wall__date">{item.date}</small>
                            <div className="h4 c-post-wall__title">{item.title}</div>                            
                            <span className="c-post-wall__comment"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7 11c-.828 0-1.5-.671-1.5-1.5s.672-1.5 1.5-1.5c.829 0 1.5.671 1.5 1.5s-.671 1.5-1.5 1.5zm5 0c-.828 0-1.5-.671-1.5-1.5s.672-1.5 1.5-1.5c.829 0 1.5.671 1.5 1.5s-.671 1.5-1.5 1.5zm5 0c-.828 0-1.5-.671-1.5-1.5s.672-1.5 1.5-1.5c.829 0 1.5.671 1.5 1.5s-.671 1.5-1.5 1.5zm5-8v13h-11.643l-4.357 3.105v-3.105h-4v-13h20zm2-2h-24v16.981h4v5.019l7-5.019h13v-16.981z"/></svg>{item.comment_num}</span>
                        </a>     
                    </article>       
                ))}
            </div>
        </div>
    );
}

ReactDOM.render(
    <div className="l-app-post-wall">
        <Provider store={store}>
            <Tag_navigation />
            <Post_wall />
        </Provider>
    </div>,
    document.getElementById('post_wall_app')
);
