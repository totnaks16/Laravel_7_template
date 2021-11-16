<template>
     <v-app>
          <div>
          
          <v-app-bar
               color="grey darken-4"
               dense
               dark
               app
               clipped-left
               >
               <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
               <v-toolbar-title>Employee System</v-toolbar-title>
               <v-spacer></v-spacer>

          </v-app-bar>

          <v-navigation-drawer
               v-model="drawer"
               color="grey darken-4"
               :src="image"
               dark
               app
               clipped
               expand-on-hover
               >
                <!--<v-list-item>
                    <v-list-item-avatar>
                         <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img>
                    </v-list-item-avatar> 

                    <v-list-item-content>
                         <v-list-item-title>John Leider</v-list-item-title>
                    </v-list-item-content>
               </v-list-item>

               <v-divider></v-divider>-->

               <v-list nav dense>
                    <v-list-item
                         v-for="item in items"
                         :key="item.title"
                         :to="item.to"
                         link
                         >
                         <v-list-item-icon>
                         <v-icon>{{ item.icon }}</v-icon>
                         </v-list-item-icon>

                         <v-list-item-content>
                         <v-list-item-title>{{ item.title }}</v-list-item-title>
                         </v-list-item-content>
                    </v-list-item>
               </v-list>
          </v-navigation-drawer>

          <!-- <h1>Vue Router Demo App</h1>

          <p>
               <router-link :to="{ name: 'home' }">Home</router-link> |
               <router-link :to="{ name: 'hello' }">Hello World</router-link>
          </p>-->
          
          <v-main class="container">
               <router-view></router-view>
          </v-main> 

          </div>
     </v-app>
</template>

<script>
     export default {
     data () {
          return {
          drawer: null,
          image: `bg.jpg`,
          items: [
               { 
                    title: 'Home', 
                    icon: 'mdi-home-variant', 
                    to: 'home'
               },
               { 
                    title: 'Hello', 
                    icon: 'mdi-hand-left', 
                    to: 'hello'
               },
          ],
          }
     },
     }
</script>