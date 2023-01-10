# I Template

## Scopo

Lo scopo del meccanismo dei *template* è quello di poter suddividere meglio il codice quando si utilizza il linguaggio PHP per generare delle pagine HTML. 

Da questo punto di vista non è essenziale, ma per progetti di una certa complessità aiuta molto, poichè:
- viene suddiviso il *controller* dalla *view*
- il *controller* conterrà il codice di business, cioè quello che manipola i dati secondo le funzionalità richieste
- la *view* conterrà la struttura HTML + del semplice codice PHP il cui unico scopo è mostrare i dati

La libreria utilizzata da noi è la libreria [Plates](https://platesphp.com/), che richiede solo la conoscenza di PHP e non di un linguaggio specifico per template.

## Composer

**Composer** è un *dipendency manager* per PHP che serve a gestire l'utilizzo di librerie esterne, ad esempio Plates.

Per installarlo basta seguire le istruzioni sul sito, una volta installato l'utilizzo che ne faremo noi può essere di due tipi (non entrambi insieme):
1. Se si vuole installare una libreria sola come Plates, basta utilizzare il comando

```bash
composer require league/plates
```
che, oltre a scaricare la libreria e le sue dipendenze, creerà un file nominato *composer.json*, che sarà dove aggiungere eventuali altri dipendenze, come indicato al prossimo punto. 
2. Creare a mano un file *composer.json* ad esempio fatto in questo modo
```json
{
  "require": {
    "league/plates": "3.*"
  }
}
```
e successivamente dare il comando
```bash
composer update
```

In tutti e due i casi il comando deve essere eseguito nella cartella di progetto. Apparirà una cartella *vendor* dove automaticamente sono state scaricate le librerie richieste.

## Architettura di Plates

Nei nostri esercizi useremo Plates nel seguente modo:
- inizialmente, nel controller, dobbiamo creare un oggetto di classe Engine. Per far questo dobbiamo prima di tutto caricare la libreria utilizzando il meccanismo di autoloading, con la seguente linea
```php
require 'vendor/autoload.php';
```
successivamente creiamo l'oggetto così

```php
$templates = new League\Plates\Engine('templates','tpl');
```

dove il primo parametro indica la cartella dove dovranno essere salvati tutti i template: nel nostro caso la cartella ha un percorso relativo poichè si trova nel nostro progetto. 

Il secondo parametro invece indica l'estensione che devono avere i nostri file di template, noi abbiamo scelto *tpl* perchè in questo modo l'editor PHPStorm la tratta già correttamente, inoltre li differenziamo da quelli puramente PHP, che quindi hanno estensione *php*.

- alla fine del controller dobbiamo iniettare nel template che ci interessa i dati che abbiamo elaborato in precedenza, utilizzando il metodo *render*

```php
echo $templates->render('nome_template', $array);
```

dove il primo parametro è il nome del file che funge da template per questo controller, il secondo invece deve essere un array, della forma di una serie di coppie chiave-valore, dove la chiave è una stringa che rappresenta un nome di variabile che poi verrà usato nel template, e il valore è il contenuto della variabile che verrà usata nel template.

Il template dovrà all'interno "stampare" le variabili che arrivano dal controller in modo che siano visibili all'utente nella forma desiderata. Se si tratta di stampare una sola variabile l'istruzione più semplice è questa
```php
<?php=$variabile?>
```

Si guardino gli esempi in questo progetto per capirne l'utilizzo. Questo progetto inoltre può essere usato come codice di partenza per i progetti che utilizzeranno Plates come motore di template.

## Esempio semplice
In questo esempio il controller è `saluti.php` mentre la sua vista è `saluti.tpl`. Da notare subito come la struttura generale dei template verrà organizzata in questo modo:
- un file, `home.tpl`, che contiene l'_involucro_ dentro il quale verrà inserito il contenuto vero e proprio. In questo modo, quando il sito sarà composto da molte pagine, tutte avranno uno stile uniforme poichè ogni contenuto avrà in comune questa pagina. Tipici contenuti che potranno essere inseriri in questa pagina saranno le inclusioni dei file CSS, i metadata, il menù di navigazione, i link per l'accesso/registrazione e altro ancora, a patto che sia comune a tutte le pagine.
- un file, il cui nome varia di volta in volta, e il cui contenuto verrà inserito nella pagina `home.tpl`, che nel caso di questo esempio è `saluti.tpl`.

In ogni template le variabili passate dal controller vengono individuate con il nome indicato
nella mappa passata al metodo `render`. In questo esempio sono state create due variabili, `$nome` e `$cognome`, che vengono passate a `render` associandole alle chiavi `nome` e `cognome` e che quindi
saranno utilizzabili in `saluti.tpl` chiamandole con i loro nomi: non è necessario che le variabili
abbiano lo stesso nome nel controller e nel template, ma è una buona idea farlo.
```php
$data = [
    'nome' => $nome,
    'cognome' => $cognome
];

echo $templates->render("saluti", $data);
```
Il metodo `render` ritorna una stringa generata con l'iniezione delle variabili dell'array e la `echo`
la ritorna al webserver, che a sua volta la ritornerà al client.

La prima riga del template contiene l'istruzione
```php
$this->layout('home', ['title' => 'Saluti']);
```
che istruisce il motore di rendering a inserire tutto quello che seguirà nella posizione individuata
dall'instruzione
```php
$this->section('content');
```
all'interno di `home.tpl`.
L'oggetto individuato da `$this` può essere pensato come il motore di rendering di Plates, che fornisce alcuni metodi come `section` e `layout`, appena visti, e un metodo molto comodo `escape`, abbreviabile in `e` come si può vedere nel codice, e che effettua l'_escaping_ della variabile che gli viene passata, evitando attacchi XSS quando il contenuto di variabili _unsafe_ vengono mostrate a video. Nel codice si trovano le istruzioni per verificare questo comportamento.

## Esempio con array
Questo esempio mostra come iniettare un array nel template per poi 
produrre un insieme di elementi come, ad esempio, le righe di una tabella,
degli elenchi puntati o altro cose del genere. Questa situazione è particolarmente
rilevamente perchè verrà incontrata spesso nelle applicazioni che incontreremo poichè, lavorando 
con i database, spesso i dati saranno in forma tabellare.

Tutto quanto detto nell'esempio semplice rimane valido: in questo esempio
nel controller è stata creata una mappa contenente 3 studenti,
individuati dal _nome_ e dal _cognome_ che è stata successivamente
passata al solito metodo `render` assegnando come chiave la stringa
'studenti', in modo che nel template sia disponibile la mappa `$studenti`
con all'interno i 3 studenti.

Nel template quindi si potrà iterare sulla mappa per visualizzarla
nella forma che si riterrà più opportuna, nell'esempio è stato scelto
di mostrare un elenco numerato e una tabella, con gli stessi dati ma con
una vista diversa.
Per iterare su una qualsiasi mappa o vettore il metodo più comodo è
quello di usare un `foreach` nel modo seguente:
```php
<li>
<?php foreach ($studenti as $studente):?>
   <li><?=$studente['nome']?> <?=$studente['cognome']?></li>
<?php endforeach;?>
</li>
```

Questo codice genererà il seguente codice HTML:
```HTML
<ul>
    <li>Antonio Albani</li>
    <li>Bianca Baloni</li>
    <li>Chiara Crusti</li>
</ul>
```
poichè il ciclo `foreach` prende come variabile prima della parola chiave
`as` il vettore o mappa che si vuole iterare, e dopo di essa il nome
della variabile come verrà usata nel corpo del ciclo.
Da notare che il blocco del `foreach`, al posto di venire delimitato
dalle più classiche parentesi graffe, lo si ottiene utilizzando la 
sintassi alternativa che prevede l'utilizzo dei due punti `:` al posto
dell'apertura della graffa e la parola chiave `endforeach` al posto
della graffa di chiusura: questa sintassi è considerata più chiara
quando si ha a che vedere con templare come in questo caso.