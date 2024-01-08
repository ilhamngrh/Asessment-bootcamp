<script setup>

    //import ref and onMounted
    import { ref, onMounted } from 'vue';

    //import api
    import api from '../../api';

    //define state
    const mahasiswas = ref([]);

    //method fetchDatamahasiswas
    const fetchDatamahasiswas = async () => {

        //fetch data 
        await api.get('/api/mahasiswas')

        .then(response => {

            //set response data to state "mahasiswas"
            mahasiswas.value = response.data.data.data

        });
    }

    //run hook "onMounted"
    onMounted(() => {

        //call method "fetchDatamahasiswas"
        fetchDatamahasiswas();
    });

</script>

<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'mahasiswa.create' }" class="btn btn-md btn-success rounded shadow border-0 mb-3">ADD NEW mahasiswa</router-link>
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Angkatan</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="mahasiswas.length == 0">
                                    <td colspan="4" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            Data Belum Tersedia!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(mahasiswa, index) in mahasiswas" :key="index">
                                    <td>{{ mahasiswa.nim }}</td>
                                    <td>{{ mahasiswa.nama }}</td>
                                    <td>{{ mahasiswa.jenis_kelamin }}</td>
                                    <td>{{ mahasiswa.jurusan }}</td>
                                    <td>{{ mahasiswa.angkatan }}</td>
                                    <td>{{ mahasiswa.alamat}}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'mahasiswas.edit', params:{id: mahasiswa.id} }" class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">EDIT</router-link>
                                        <button class="btn btn-sm btn-danger rounded-sm shadow border-0">DELETE</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>