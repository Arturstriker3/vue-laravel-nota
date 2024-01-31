<script setup>
import { onMounted, ref } from "vue"
import { useRouter } from "vue-router"

const router = useRouter()

  let form = ref({ id:'' })

  const props = defineProps({
    id:{
        type:String,
        default:''
    }
  })

  onMounted(async () => {
    getInvoice()
  })

  const getInvoice = async () => {
    let response = await axios.get(`/api/show_invoice/${props.id}`)
    //console.log('form', response.data.invoice)
    form.value = response.data.invoice;
    
  }

  const print = () => {
    window.print()
    router.push('/').catch(() => {})
  }

  const onEdit = (id) => {
     router.push('/invoice/edit/'+id)
  }

  const deleteInvoice = (id) => {
    axios.get('/api/delete_invoice/'+id)
    router.push('/')
  }

</script>
<template>
   <div class="container">
        <div class="invoices">
        
        <div class="card__header">
            <div>
                <h2 class="invoice__title">Nota</h2>
            </div>
            <div>
                
            </div>
        </div>
        <div>
            <div class="card__header--title ">
                <h1 class="mr-2">#{{form.id}}</h1>
                <p>{{form.created_at}} </p>
            </div>
    
            <div>
                <ul  class="card__header-list">
                    <li>
                        <!-- Select Btn Option -->
                        <button class="selectBtnFlat" @click="print()">
                            <i class="fas fa-print"></i>
                            Imprimir
                        </button>
                        <!-- End Select Btn Option -->
                    </li>
                    <li>
                        <!-- Select Btn Option -->
                        <button class="selectBtnFlat" @click="onEdit(form.id)">
                            <i class=" fas fa-reply"></i>
                            Editar
                        </button>
                        <!-- End Select Btn Option -->
                    </li>
                    <li>
                        <!-- Select Btn Option -->
                        <button class="selectBtnFlat " @click="deleteInvoice(form.id)">
                            <i class=" fas fa-pencil-alt"></i>
                            Deletar
                        </button>
                        <!-- End Select Btn Option -->
                    </li>
                    
                </ul>
            </div>
        </div>

        <div class="table invoice">
            <div class="logo">
                <img src="../invoices/logo.svg" alt="" style="width: 50px;">
            </div>
            <div class="invoice__header--title">
                <p></p>
                <p class="invoice__header--title-1">Nota</p>
                <p></p>
            </div>

            
            <div class="invoice__header--item">
                <div>
                    <h2>Compra feita por:</h2>
                    <p v-if="form.customer">
                      {{form.customer.firstname}}
                    </p>
                </div>
                <div>
                        <div class="invoice__header--item1">
                            <p>Nota</p>
                            <span>#{{form.number}}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Data</p>
                            <span>{{form.date}}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Data Pagamento</p>
                            <span>{{form.due_date}}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Referência</p>
                            <span>{{form.reference}}</span>
                        </div>
                    
                </div>
            </div>

            <div class="table py1">

                <div class="table--heading3">
                    <p>#</p>
                    <p>Itens Comprados</p>
                    <p>Preço (u)</p>
                    <p>Qtd</p>
                    <p>Total</p>
                </div>
    
                <!-- item 1 -->
                <div class="table--items3" v-for="(item,i) in form.invoice_items" :key="item.id">
                    <p>{{i+1}}</p>
                    <p>{{item.product.description}}</p>
                    <p>$ {{item.unit_price}}</p>
                    <p>{{item.quantity}}</p>
                    <p>$ {{item.unit_price * item.quantity}}</p>
                </div>
            </div>

            <div  class="invoice__subtotal">
                <div>
                    <h2>Obrigado pela preferência</h2>   
                </div>
                <div>
                    <div class="invoice__subtotal--item1">
                        <p>Preço parcial:</p>
                        <span> R$ {{form.sub_total}}</span>
                    </div>
                    <div class="invoice__subtotal--item2">
                        <p>Desconto:</p>
                        <span>R$ {{form.discount}}</span>
                    </div>
                    
                </div>
            </div>

            <div class="invoice__total">
                <div>
                    <h2>Termos e Condições</h2>
                    <p>{{form.terms_and_conditions}} </p>
                </div>
                <div>
                    <div class="grand__total" >
                        <div class="grand__total--items">
                            <p>Preço Total:</p>
                            <span>R$ {{form.total}}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
     
        
    </div>
      <br>
   </div>
</template>