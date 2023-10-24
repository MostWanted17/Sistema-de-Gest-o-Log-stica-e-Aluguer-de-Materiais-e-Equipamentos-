class Viagem {
    constructor() {
        this.injectMysql = new InjectMysql(); // Instância da classe InjectMysql para realizar chamadas AJAX
        this.startMarker = null; // Marcador de partida
        this.endMarker = null; // Marcador de chegada
        this.routePolyline = null; // Polilinha da rota
        this.routingControl = null; // Controle de roteamento
        this.numClicks = 0;
    }

    async viagem() {
        const tableBody = document.getElementById('table-body-viagem');
        const response = await this.injectMysql.ajaxCall(Config.viagem);
        const session = await this.injectMysql.ajaxCall(Config.getSession);
        let html = '';
        for (let i = 0; i < response.length; i++) {
            const { id_viagem, matricula, motorista, carga, origem, destino, descricao, peso_carga, valor_carga, data_saida, previsao_chegada, status } = response[i];
            if (session['id_nivel'] == 1) {
                if (status == 'concluido') {
                    html += `
            <tr class="tr-shadow">
                <td>${id_viagem}</td>
                <td>${matricula}</td>
                <td>${motorista}</td>
                <td>${carga}</td>
                <td>
                    <span class="block-email">${origem}</span>
                </td>
                <td>
                    <span class="block-email">${destino}</span>
                </td>
                <td class="desc">${descricao}</td>
                <td>${peso_carga}</td>
                <td>${valor_carga}</td>
                <td>${data_saida}</td>
                <td>${previsao_chegada}</td>
                <td>${status}</td>
                <td>
                    <div class="table-data-feature">
                    <button class="item" data-toggle="tooltip" data-placement="top" title="See" onclick="new Viagem().seeCoordinates('${origem}', '${destino}')">
                                <i class="fa fa-eye"></i>
                            </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="new Viagem().editViagem(${id_viagem},'${descricao}')">
                            <i class="zmdi zmdi-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
            `;
                } else {
                    html += `
                <tr class="tr-shadow">
                    <td>${id_viagem}</td>
                    <td>${matricula}</td>
                    <td>${motorista}</td>
                    <td>${carga}</td>
                    <td>
                        <span class="block-email">${origem}</span>
                    </td>
                    <td>
                        <span class="block-email">${destino}</span>
                    </td>
                    <td class="desc">${descricao}</td>
                    <td>${peso_carga}</td>
                    <td>${valor_carga}</td>
                    <td>${data_saida}</td>
                    <td>${previsao_chegada}</td>
                    <td>${status}</td>
                    <td>
                        <div class="table-data-feature">
                        <button class="item" data-toggle="tooltip" data-placement="top" title="See" onclick="new Viagem().seeCoordinates('${origem}', '${destino}')">
                                <i class="fa fa-eye"></i>
                            </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Concluido" onclick="new Viagem().finishedViagem(${id_viagem})">
                                <i class="fa fa-check"></i>
                            </button>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="new Viagem().editViagem(${id_viagem},'${descricao}')">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="new Viagem().removeViagem(${id_viagem})">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                `;
                }
            }else{
                if (status == 'concluido') {
                    html += `
            <tr class="tr-shadow">
                <td>${id_viagem}</td>
                <td>${matricula}</td>
                <td>${motorista}</td>
                <td>${carga}</td>
                <td>
                    <span class="block-email">${origem}</span>
                </td>
                <td>
                    <span class="block-email">${destino}</span>
                </td>
                <td class="desc">${descricao}</td>
                <td>${peso_carga}</td>
                <td>${valor_carga}</td>
                <td>${data_saida}</td>
                <td>${previsao_chegada}</td>
                <td>${status}</td>
                <td>
                    <div class="table-data-feature">
                    <button class="item" data-toggle="tooltip" data-placement="top" title="See" onclick="new Viagem().seeCoordinates('${origem}', '${destino}')">
                                <i class="fa fa-eye"></i>
                            </button>
                    </div>
                </td>
            </tr>
            `;
                } else {
                    html += `
                <tr class="tr-shadow">
                    <td>${id_viagem}</td>
                    <td>${matricula}</td>
                    <td>${motorista}</td>
                    <td>${carga}</td>
                    <td>
                        <span class="block-email">${origem}</span>
                    </td>
                    <td>
                        <span class="block-email">${destino}</span>
                    </td>
                    <td class="desc">${descricao}</td>
                    <td>${peso_carga}</td>
                    <td>${valor_carga}</td>
                    <td>${data_saida}</td>
                    <td>${previsao_chegada}</td>
                    <td>${status}</td>
                    <td>
                        <div class="table-data-feature">
                        <button class="item" data-toggle="tooltip" data-placement="top" title="See" onclick="new Viagem().seeCoordinates('${origem}', '${destino}')">
                                <i class="fa fa-eye"></i>
                            </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Concluido" onclick="new Viagem().finishedViagem(${id_viagem})">
                                <i class="fa fa-check"></i>
                        </div>
                    </td>
                </tr>
                `;
                }
            }
        }
        tableBody.innerHTML = html;
    }
    async removeViagem(id_viagem) {
        const response = await this.injectMysql.ajaxPOST(Config.removeViagem, [id_viagem]);
        if (response === 0) {
            await new InjectMysql().successCallback('Error', 'Removed error!', 'sucess');
        } else {
            await new InjectMysql().successCallback('Removed', 'Removed with sucess!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }
    async accepteViagem(id_viagem) {
        const response = await this.injectMysql.ajaxPOST(Config.accepteViagem, [id_viagem]);
        if (response === 0) {
            await new InjectMysql().successCallback('Error', 'Removed error!', 'sucess');
        } else {
            await new InjectMysql().successCallback('Removed', 'Removed with sucess!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }
    async finishedViagem(id_viagem) {
        const response = await this.injectMysql.ajaxPOST(Config.finishedViagem, [id_viagem]);
        if (response === 0) {
            await new InjectMysql().successCallback('Error', 'Finisehd error!', 'sucess');
        } else {
            await new InjectMysql().successCallback('Finished', 'Finished with sucess!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }
    async editViagem(id_viagem, descricao) {
        Swal.fire({
            title: 'Edit information',
            html:
                `<input id="descricao" class="swal2-input" placeholder="Descricao" value=${descricao}>`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const data = {
                    // Obtenha os dados do formulário
                    id_viagem: id_viagem,
                    descricao: document.getElementById('descricao').value
                };
                return data;
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const { id_viagem, descricao } = result.value;
                // Faça algo com os valores de entrada
                const response = await new InjectMysql().ajaxPOST(Config.editViagem, [id_viagem, descricao]);

                if (response === 0) {
                    await new InjectMysql().successCallback('Error', 'Error to edit!', 'sucess');
                } else {
                    await new InjectMysql().successCallback('Edit', 'Edit with sucess!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }

    async addViagem() {

        const listaCarro = await this.injectMysql.ajaxCall(Config.carroDisponivel);;
        const listaMotorista = await this.injectMysql.ajaxCall(Config.motoristaDisponivel);;
        const listaCarga = await this.injectMysql.ajaxCall(Config.carga);;

        let selectOptionsCarro = '';
        let selectOptionsMotorista = '';
        let selectOptionsCarga = '';

        for (let i = 0; i < listaCarro.length; i++) {
            const { id_carro, matricula } = listaCarro[i];
            selectOptionsCarro += `<option value="${id_carro}">${matricula}</option>`;
        }
        const selectHTMLCarro = `
        <div class="form-group form-group-1">
    <label class="descricao-label" for="matricula">Descrição do Carro:</label>
    <select id="matricula" class="swal2-select custom-select">${selectOptionsCarro}</select>
  </div>`;

        for (let i = 0; i < listaMotorista.length; i++) {
            const { id_motorista, nome } = listaMotorista[i];
            selectOptionsMotorista += `<option value="${id_motorista}">${nome}</option>`;
        }
        const selectHTMLMotorista = `
        <div class="form-group form-group-1">
    <label class="descricao-label" for="motorista">Descrição do Motorista:</label>
    <select id="motorista" class="swal2-select custom-select">${selectOptionsMotorista}</select>
  </div>`;

        for (let i = 0; i < listaCarga.length; i++) {
            const { id_carga, descricao } = listaCarga[i];
            selectOptionsCarga += `<option value="${id_carga}">${descricao}</option>`;
        }
        const selectHTMLCarga = `
        <div class="form-group form-group-1">
    <label class="descricao-label" for="carga">Descrição da Carga:</label>
    <select id="carga" class="swal2-select custom-select">${selectOptionsCarga}</select>
  </div>`;


        Swal.fire({
            title: 'Add information',
            html:

                selectHTMLCarro + selectHTMLMotorista + selectHTMLCarga +
                `<input id="descricao" class="swal2-input" placeholder="Descricao">` +
                `<input id="peso" class="swal2-input" placeholder="Peso">` +
                `<input id="valor" class="swal2-input" placeholder="Valor da Carga">` +
                `<div class="form-group form-group-1">
                <label class="descricao-label" for="saida">Data de Saida:</label><input id="saida" class="swal2-input" type="date"></div>` +
                `<div class="form-group form-group-1">
                <label class="descricao-label" for="previsao">Previsao de Chegada:</label><input id="previsao" class="swal2-input" type="date"></div>` +
                `<div class="form-group form-group-1">
                <label class="descricao-label" for="map">Coordenadas:</label><div id="map" style="height: 300px;"></div></div>`, // Adicione o elemento HTML para exibir o mapa
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const startCoordinates = startMarker ? startMarker.getLatLng() : null;
                const endCoordinates = endMarker ? endMarker.getLatLng() : null;
                const startCoordinatesString = Object.values(startCoordinates).join(',');
                const endCoordinatesString = Object.values(endCoordinates).join(',');
                const data = {
                    // Obtenha os dados do formulário
                    matricula: document.getElementById('matricula').value,
                    motorista: document.getElementById('motorista').value,
                    carga: document.getElementById('carga').value,
                    descricao: document.getElementById('descricao').value,
                    peso: document.getElementById('peso').value,
                    valor: document.getElementById('valor').value,
                    saida: document.getElementById('saida').value,
                    previsao: document.getElementById('previsao').value,
                    startCoordinates: startCoordinatesString,
                    endCoordinates: endCoordinatesString
                };
                return data;
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const { matricula, motorista, carga, descricao, peso, valor, saida, previsao, startCoordinates, endCoordinates } = result.value;

                const response = await new InjectMysql().ajaxPOST(Config.addViagem, [matricula, motorista, carga, descricao, peso, valor, saida, previsao, startCoordinates, endCoordinates]);
                if (response === 0) {
                    await new InjectMysql().successCallback('Error', 'Error to add!', 'sucess');
                } else {
                    await new InjectMysql().successCallback('Add', 'Add with sucess!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });

        const mapElement = document.getElementById('map');
        const map = L.map(mapElement).setView([-19.83003, 34.83768], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);

        var startMarker = null; // Marcador de partida
        var endMarker = null; // Marcador de chegada
        var routePolyline = null; // Polilinha da rota
        var routingControl = null; // Controle de roteamento

        map.on('click', function (e) {
            var clickedCoordinates = e.latlng;

            if (!startMarker) {
                startMarker = L.marker(clickedCoordinates).addTo(map);
            } else if (!endMarker) {
                endMarker = L.marker(clickedCoordinates).addTo(map);

                if (routingControl) {
                    routingControl.spliceWaypoints(0, 2);
                    map.removeControl(routingControl);
                }

                createRoute();
            } else {
                map.removeLayer(endMarker);
                endMarker = null;
                if (routePolyline) {
                    map.removeLayer(routePolyline);
                }
                startMarker.setLatLng(clickedCoordinates);
            }
            var routingContainer = document.getElementsByClassName('leaflet-routing-container')[0];
            routingContainer.remove();
        });

        function createRoute() {
            var startCoordinates = startMarker.getLatLng();
            var endCoordinates = endMarker.getLatLng();

            routingControl = L.Routing.control({
                waypoints: [
                    L.latLng(startCoordinates.lat, startCoordinates.lng),
                    L.latLng(endCoordinates.lat, endCoordinates.lng)
                ],
                routeWhileDragging: true,
                show: false,
                createMarker: function (i, waypoint, n) {
                    if (i === 0) {
                        return L.marker(waypoint.latLng, {
                            icon: L.icon({
                                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [1, -34],
                                shadowSize: [41, 41]
                            })
                        });
                    } else if (i === n - 1) {
                        return L.marker(waypoint.latLng, {
                            icon: L.icon({
                                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [1, -34],
                                shadowSize: [41, 41]
                            })
                        });
                    } else {
                        return L.marker(waypoint.latLng);
                    }
                }
            }).addTo(map);

            routingControl.on('routesfound', function (e) {
                var routes = e.routes;
                var routeCoordinates = routes[0].coordinates;

                if (routePolyline) {
                    map.removeLayer(routePolyline);
                }

                routePolyline = L.polyline(routeCoordinates, { color: 'red' }).addTo(map);

                map.fitBounds(routePolyline.getBounds());
            });

        }
    }
    async seeCoordinates(start, end) {
        // Exibir o diálogo do Swal
        Swal.fire({
            title: 'See information',
            html: `<label class="descricao-label" for="map">Coordenadas:</label><div id="map" style="height: 300px;"></div>`,
            showCancelButton: true,
        });

        const mapElement = document.getElementById('map');
        const map = L.map(mapElement).setView([-19.83003, 34.83768], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);

        const startC = start.split(",").map(coord => parseFloat(coord));
        const endC = end.split(",").map(coord => parseFloat(coord));

        // Função para adicionar marcadores ao mapa
        function addMarkersToMap(startCoords, endCoords) {
            L.marker(startCoords).addTo(map).bindPopup('Origem');
            L.marker(endCoords).addTo(map).bindPopup('Destino');
        }

        // Adicionar marcadores ao mapa
        addMarkersToMap(startC, endC);

        // Criar uma instância do controle de roteamento do Leaflet
        const routingControl = L.Routing.control({
            waypoints: [
                L.latLng(startC[0], startC[1]),
                L.latLng(endC[0], endC[1])
            ],
            routeWhileDragging: true,
            show: false,
            createMarker: function (i, waypoint, n) {
                if (i === 0) {
                    return L.marker(waypoint.latLng, {
                        icon: L.icon({
                            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [1, -34],
                            shadowSize: [41, 41]
                        })
                    });
                } else if (i === n - 1) {
                    return L.marker(waypoint.latLng, {
                        icon: L.icon({
                            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [1, -34],
                            shadowSize: [41, 41]
                        })
                    });
                } else {
                    return L.marker(waypoint.latLng);
                }
            }
        }).addTo(map);

        // Evento disparado quando a rota é calculada
        routingControl.on('routesfound', function (e) {
            var routes = e.routes;
            var routeCoordinates = routes[0].coordinates;

            var routePolyline = L.polyline(routeCoordinates, { color: 'red' }).addTo(map);
            map.fitBounds(routePolyline.getBounds());
        });
        var routingContainer = document.getElementsByClassName('leaflet-routing-container')[0];
        routingContainer.remove();
    }

}

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const viagem = new Viagem();
        await viagem.viagem();
    } catch (error) {
        console.error(error);
    }
});