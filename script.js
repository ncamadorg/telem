/*
  Mediante la tecnologia de Vue y Axios se realiza la conexion entre el backend
  y el frontend, para permitir una mayor recursividad mientras se hace uso de la
  aplicacion; Vuex carga los dato adquiridos en formato JSON y envia el/los objetos
  a Vue para trabajarlos en el frontend.
*/

//Cargamos Vuex
const store = new Vuex.Store({
  state: {
    // Definimos variables
    files: null
  },
  mutations: {
    // Cargamos los datos obtenidos en JSON a la memoria del computador
    SET_FILES(state, filesAction) {
      state.files = filesAction
    }
  },
  actions: {

    /*
      Hacemos la peticion del listado de archivos mediante una peticion get
      de forma asincrona para evitar saturacion de peticiones al servidor y
      mejorar la experiencia de usuario
    */
    getDir: async({commit, state}) => {

      await axios.get('scan.php')
      // Obtenemos el listado de los archivos
        .then((r => r.data.items))
      // en caso de error, mostramos el error mediante consola
        .catch((error) => {
          console.log(error);
        })
      /*
        Una vez cargados el listado de archivos, enviamos el array para ser
        almacenado en memoria
      */
        .then(files => {
          commit('SET_FILES', files)
        })
    }
  }
})

// Creamos el componente
const app = new Vue({
  // Definimos la etiqueta que sera nuestro componente
  el: '#app',
  // Cargamos las tareas hechas con Vuex para manipular los datos
  store,
  methods: {
    // Cargamos la consulta de los archivos
    ...Vuex.mapActions(["getDir"]),
  },
  computed: {
    // Cargamos el arreglo con la informacion de los archivos al componente
    ...Vuex.mapState(["files"]),
  },
  beforeMount() {
    // Ejecutamos la consulta entes de que se carge la interfaz
    this.getDir()
  }
})