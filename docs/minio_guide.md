# Guia de Uso do MinIO com Laravel Sail

## Configuração

O MinIO já está configurado no seu projeto Laravel com as seguintes configurações:

- **Acesso MinIO Console**: http://localhost:8900
- **Endpoint MinIO**: http://localhost:9000
- **Usuário**: sail
- **Senha**: password
- **Bucket padrão**: local

## Como usar

### 1. Upload de arquivos via API

```bash
# Upload de um arquivo
curl -X POST http://localhost/api/files/upload \
  -F "file=@caminho/para/seu/arquivo.jpg" \
  -F "folder=uploads/images"
```

### 2. Upload via Interface Web

Acesse: http://localhost/upload

### 3. Uso no código Laravel

```php
use Illuminate\Support\Facades\Storage;

// Upload de arquivo
$path = Storage::disk('minio')->put('uploads/arquivo.txt', $conteudo);

// Verificar se arquivo existe
if (Storage::disk('minio')->exists($path)) {
    // Arquivo existe
}

// Baixar arquivo
$conteudo = Storage::disk('minio')->get($path);

// Listar arquivos
$arquivos = Storage::disk('minio')->files('uploads');

// Deletar arquivo
Storage::disk('minio')->delete($path);

// Obter tamanho do arquivo
$tamanho = Storage::disk('minio')->size($path);

// Data de modificação
$ultimaModificacao = Storage::disk('minio')->lastModified($path);
```

### 4. Integrando com Models

Exemplo de como integrar upload de imagem em um model Character:

```php
class Character extends Model
{
    protected $fillable = ['name', 'description', 'image_path'];

    public function uploadImage($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = 'characters/' . $fileName;
        
        Storage::disk('minio')->put($path, file_get_contents($file));
        
        $this->update(['image_path' => $path]);
        
        return $path;
    }

    public function getImageUrl()
    {
        if ($this->image_path) {
            return route('files.download', ['filePath' => $this->image_path]);
        }
        return null;
    }

    public function deleteImage()
    {
        if ($this->image_path && Storage::disk('minio')->exists($this->image_path)) {
            Storage::disk('minio')->delete($this->image_path);
            $this->update(['image_path' => null]);
        }
    }
}
```

## APIs Disponíveis

### Upload
- **POST** `/api/files/upload`
- **Parâmetros**: `file` (required), `folder` (optional)

### Listar arquivos
- **GET** `/api/files/list?folder=uploads`

### Download
- **GET** `/api/files/download/{filePath}`

### Deletar
- **DELETE** `/api/files/delete/{filePath}`

## Console do MinIO

Para acessar o console do MinIO:
1. Acesse: http://localhost:8900
2. Usuário: sail
3. Senha: password

Lá você pode:
- Criar novos buckets
- Gerenciar arquivos visualmente
- Configurar políticas de acesso
- Monitorar uso

## Comandos Úteis

```bash
# Verificar status dos containers
./vendor/bin/sail ps

# Reiniciar apenas o MinIO
./vendor/bin/sail restart minio

# Ver logs do MinIO
./vendor/bin/sail logs minio

# Executar comandos no container do MinIO
./vendor/bin/sail exec minio mc ls local
```

## Troubleshooting

### Erro de conexão
- Verifique se os containers estão rodando: `./vendor/bin/sail ps`
- Reinicie o MinIO: `./vendor/bin/sail restart minio`

### Bucket não existe
- Acesse o console do MinIO e crie o bucket "local"
- Ou execute: `./vendor/bin/sail artisan tinker` e rode:
  ```php
  $s3 = Storage::disk('minio');
  // Comandos para criar bucket...
  ```

### Permissões
- Verifique as credenciais no `.env`
- Certifique-se que `AWS_USE_PATH_STYLE_ENDPOINT=true`
