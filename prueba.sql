DECLARE @UserName NVARCHAR(50);
SET @UserName = 'admin'' --'; -- Esta es la parte "maliciosa" que simula la inyección

DECLARE @SQL nvarchar(MAX);
SET @SQL = 'SELECT * FROM Users WHERE UserName = ''' + @UserName + '''';
EXEC sp_executesql @SQL; -- SonarLint debería marcar la concatenación aquí
