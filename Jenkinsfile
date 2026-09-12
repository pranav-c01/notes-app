pipeline {
    agent { label "dev" }

    environment {
        DOCKER_CREDS   = credentials('Docker_Hub_Id_Pwd')
        IMAGE_NAME     = "notes-app"
        IMAGE_TAG      = "v1.${BUILD_NUMBER}"
        CONTAINER_NAME = "notes-app-container"
        PORT           = "9092"
        HOST_IP        = "15.206.27.95"
    }

    stages {
        stage('Checkout Code') {
            steps {
                git branch: 'master', url: 'https://github.com/Satyams-git/notes-app.git'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh '''
                    echo "===== Building Docker Image ====="
                    docker build -t ${IMAGE_NAME}:${IMAGE_TAG} .
                '''
            }
        }

        stage('Tag & Push Image') {
            steps {
                sh '''
                    echo "===== Logging in to Docker Hub ====="
                    echo "$DOCKER_CREDS_PSW" | docker login -u "$DOCKER_CREDS_USR" --password-stdin

                    echo "===== Tagging Image ====="
                    docker tag ${IMAGE_NAME}:${IMAGE_TAG} ${DOCKER_CREDS_USR}/${IMAGE_NAME}:${IMAGE_TAG}

                    echo "===== Pushing Image ====="
                    docker push ${DOCKER_CREDS_USR}/${IMAGE_NAME}:${IMAGE_TAG}
                '''
            }
        }

        stage('Stop Old Container') {
            steps {
                sh '''
                    echo "===== Stopping Old Container ====="
                    docker stop ${CONTAINER_NAME} || true
                    docker rm ${CONTAINER_NAME} || true
                '''
            }
        }

        stage('Run New Container') {
            steps {
                sh '''
                    echo "===== Running New Container ====="
                    docker run -d --name ${CONTAINER_NAME} -p ${PORT}:80 -v notes-data:/data ${DOCKER_CREDS_USR}/${IMAGE_NAME}:${IMAGE_TAG}
                '''
            }
        }

        stage('Verify Deployment') {
            steps {
                sh '''
                    echo "===== Verifying App ====="
                    sleep 10
                    curl -f http://${HOST_IP}:${PORT}
                '''
            }
        }
    }

    post {
        success {
            echo "===== Deployment Successful: http://${HOST_IP}:${PORT} ====="
            emailext(
                subject: "Build Successful",
                body: "Build was Successful - Congrats!",
                to: "satyam.du.in@gmail.com"
            )
        }
        failure {
            echo "===== Deployment Failed! Check logs ====="
            emailext(
                subject: "Build Failed",
                body: "Oops! Build Failed",
                to: "satyam.du.in@gmail.com"
            )
        }
        always {
            sh '''
                echo "===== Cleaning Unused Images ====="
                docker image prune -f
            '''
        }
    }
}
