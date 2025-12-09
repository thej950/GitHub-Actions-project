FROM mysql:5.7

# Set MySQL root password (required)
ENV MYSQL_ROOT_PASSWORD=whizlabs

# Copy your initialization script into MySQL's auto-run folder
COPY init.sql /docker-entrypoint-initdb.d/

# Expose MySQL port
EXPOSE 3306
