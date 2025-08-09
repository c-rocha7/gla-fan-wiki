<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivos - MinIO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
        .upload-area {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            margin: 20px 0;
        }
        .upload-area:hover {
            border-color: #007bff;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .file-list {
            margin-top: 20px;
        }
        .file-item {
            background: #f8f9fa;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .progress {
            width: 100%;
            height: 20px;
            background-color: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            margin: 10px 0;
        }
        .progress-bar {
            height: 100%;
            background-color: #28a745;
            width: 0%;
            transition: width 0.3s;
        }
    </style>
</head>
<body>
    <h1>Upload de Arquivos com MinIO</h1>

    <div class="upload-area" id="uploadArea">
        <p>Arraste arquivos aqui ou clique para selecionar</p>
        <input type="file" id="fileInput" multiple style="display: none;">
        <button class="btn" onclick="document.getElementById('fileInput').click()">
            Selecionar Arquivos
        </button>
    </div>

    <div class="progress" id="progressContainer" style="display: none;">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <div>
        <label for="folderInput">Pasta (opcional):</label>
        <input type="text" id="folderInput" placeholder="ex: uploads/images" style="margin: 10px; padding: 5px;">
    </div>

    <button class="btn" onclick="loadFiles()">Atualizar Lista de Arquivos</button>

    <div class="file-list" id="fileList">
        <!-- Lista de arquivos será carregada aqui -->
    </div>

    <script>
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const progressContainer = document.getElementById('progressContainer');
        const progressBar = document.getElementById('progressBar');
        const fileList = document.getElementById('fileList');
        const folderInput = document.getElementById('folderInput');

        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#007bff';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = '#ccc';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#ccc';
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function handleFiles(files) {
            Array.from(files).forEach(file => {
                uploadFile(file);
            });
        }

        async function uploadFile(file) {
            const formData = new FormData();
            formData.append('file', file);

            const folder = folderInput.value.trim();
            if (folder) {
                formData.append('folder', folder);
            }

            progressContainer.style.display = 'block';

            try {
                const response = await fetch('/api/files/upload', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });

                const result = await response.json();

                if (result.success) {
                    alert('Arquivo enviado com sucesso!');
                    loadFiles(); // Recarregar lista
                } else {
                    alert('Erro: ' + result.message);
                }
            } catch (error) {
                alert('Erro ao enviar arquivo: ' + error.message);
            } finally {
                progressContainer.style.display = 'none';
                progressBar.style.width = '0%';
            }
        }

        async function loadFiles() {
            try {
                const folder = folderInput.value.trim() || 'uploads';
                const response = await fetch(`/api/files/list?folder=${encodeURIComponent(folder)}`);
                const result = await response.json();

                if (result.success) {
                    displayFiles(result.files);
                } else {
                    fileList.innerHTML = '<p>Erro ao carregar arquivos: ' + result.message + '</p>';
                }
            } catch (error) {
                fileList.innerHTML = '<p>Erro ao carregar arquivos: ' + error.message + '</p>';
            }
        }

        function displayFiles(files) {
            if (files.length === 0) {
                fileList.innerHTML = '<p>Nenhum arquivo encontrado.</p>';
                return;
            }

            let html = '<h3>Arquivos:</h3>';
            files.forEach(file => {
                const size = formatFileSize(file.size);
                const date = new Date(file.last_modified * 1000).toLocaleString('pt-BR');

                html += `
                    <div class="file-item">
                        <div>
                            <strong>${file.name}</strong><br>
                            <small>Tamanho: ${size} | Modificado: ${date}</small>
                        </div>
                        <div>
                            <button class="btn" onclick="downloadFile('${file.path}')">Download</button>
                            <button class="btn btn-danger" onclick="deleteFile('${file.path}')">Excluir</button>
                        </div>
                    </div>
                `;
            });

            fileList.innerHTML = html;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        async function downloadFile(filePath) {
            try {
                const response = await fetch(`/api/files/download/${encodeURIComponent(filePath)}`);

                if (response.ok) {
                    const blob = await response.blob();
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = filePath.split('/').pop();
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);
                } else {
                    alert('Erro ao baixar arquivo');
                }
            } catch (error) {
                alert('Erro ao baixar arquivo: ' + error.message);
            }
        }

        async function deleteFile(filePath) {
            if (!confirm('Tem certeza que deseja excluir este arquivo?')) {
                return;
            }

            try {
                const response = await fetch(`/api/files/delete/${encodeURIComponent(filePath)}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });

                const result = await response.json();

                if (result.success) {
                    alert('Arquivo excluído com sucesso!');
                    loadFiles(); // Recarregar lista
                } else {
                    alert('Erro: ' + result.message);
                }
            } catch (error) {
                alert('Erro ao excluir arquivo: ' + error.message);
            }
        }

        // Carregar arquivos ao carregar a página
        window.addEventListener('load', loadFiles);
    </script>
</body>
</html>
