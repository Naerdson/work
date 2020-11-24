import{Cliente} from "./Cliente.js"
import {Gerente} from "./Funcionarios/Gerente.js"
import {Diretor} from "./Funcionarios/Diretor.js"
import {SistemaAutenticacao} from "./SistemaAutenticacao.js"

const diretor = new Diretor("Naerdson",10000,123456789900);
diretor.cadastarSenha("123456");
const gerente = new Gerente ("José",5000,98765432199);
gerente.cadastarSenha("123");

const cliente = new Cliente("bia",12345678900, "456")
const gerenteEstaLogado = SistemaAutenticacao.login(gerente,"123");
const diretorEstaLogado = SistemaAutenticacao.login(diretor,"123456");

const clienteEstaLogado = SistemaAutenticacao.login(cliente,"456")

console.log(gerenteEstaLogado,diretorEstaLogado,clienteEstaLogado);