import { toast } from "vue3-toastify";
import 'vue3-toastify/dist/index.css'

const defaultConfig = {
    autoClose: 5000,
    position: 'bottom-center'
}

export  function useNotification() {

    return {
        error(message, config= defaultConfig) {
            toast.error(message, config)
        },

        warn(message, config= defaultConfig) {
            toast.warn(message, config)
        },

        success(message, config= defaultConfig) {
            toast.success(message, config)
        },

        info(message, config= defaultConfig) {
            toast.info(message, config)
        }
    }
}


